
//String mac=WiFi.macAddress();
const int analogInPin = 15;  // ESP8266 Analog Pin ADC0 = A0
String dato;
int PosicionComa; //Variable que nos dice la posicion de la coma en el mensaje.
int led_exi=16;
int led_denegado=5;
#include <SPI.h>//libreria nesesaria para el rfid
#include <MFRC522.h>
#define SS_PIN 2//definendopin delrfid
#define RST_PIN 4

MFRC522 mfrc522(SS_PIN, RST_PIN); // Instance of the class
//si usas esp32
//#include <HTTPClient.h>
//#include <WiFi.h>
//si usas esp8266
#include <ESP8266WiFiMulti.h>///librerias para elwifi
#include <ESP8266HTTPClient.h>
//lacontraseña y el nombre de la red
//nombre y contaseña de la casa
//char* ssid = "ARRIS-04F2";
//const char* password =  "4CE31B26A0B75370";
//nombre y contaseña de la escuela
//const char* ssid = "UTeM-Administrativos";
//const char* password = "utemadministrativos";
//modem de prueba
char* ssid = "Magic_red";
const char* password =  "12345678";
String user ;//dato que  enviaremos en post
String pass = "12345";
void setup() {
  pinMode(analogInPin,OUTPUT);
  pinMode(led_exi,OUTPUT);
  pinMode(led_denegado,OUTPUT);
  
    digitalWrite(analogInPin,LOW);
  SPI.begin();       // Init SPI bus
  mfrc522.PCD_Init(); // Init MFRC522

  delay(10);
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  //definiendo entradas y salidas
  

  Serial.print("Conectando...");
  while (WiFi.status() != WL_CONNECTED) { //Check for the connection
    delay(500);
    Serial.print(".");
  }

  Serial.print("Conectado con éxito, mi IP es: ");
  Serial.println(WiFi.localIP());
}
void loop() {
        digitalWrite(analogInPin,LOW);
  if ( mfrc522.PICC_IsNewCardPresent())
  {
    if ( mfrc522.PICC_ReadCardSerial())
    {
    //  Serial.print("Tag UID:");
      //uniendol losbalores en una bariable
      user = mfrc522.uid.uidByte[0], HEX;
      user += mfrc522.uid.uidByte[1], HEX;
      user += mfrc522.uid.uidByte[3], HEX;
      user += mfrc522.uid.uidByte[4], HEX;
      //Serial.print(user);
      if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status
        HTTPClient http;
        String datos_a_enviar = "user=" + user + "&pass=" + pass; // datos aenviar
       // http.begin("http://172.16.84.200/rfid/checklogin.php");        //Indicamos el destino
        http.begin("http://192.168.0.6/acceso/Model/arduino/salida.php");        //Indicamos el destino
        http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Preparamos el header text/plain si solo vamos a enviar texto plano sin un paradigma llave:valor.
        int codigo_respuesta = http.POST(datos_a_enviar);   //Enviamos el post pasándole, los datos que queremos enviar. (esta función nos devuelve un código que guardamos en un int)
        if (codigo_respuesta > 0) {
        //  Serial.println("Código HTTP ► " + String(codigo_respuesta));   //Print return code
          if (codigo_respuesta == 200) { //si la conexion fue esitosa
            String cuerpo_respuesta = http.getString();
          //  Serial.println("El servidor respondió ▼ ");
            //Serial.println(cuerpo_respuesta);
            //  PosicionComa = cuerpo_respuesta.indexOf (',');
             //Serial.println (cuerpo_respuesta.substring (0, PosicionComa));
             // cuerpo_respuesta = cuerpo_respuesta.substring (PosicionComa+1, cuerpo_respuesta.length());
             cuerpo_respuesta.trim(); 
             Serial.println(cuerpo_respuesta);
             if (cuerpo_respuesta == "aprobado") { //siel cuerpo resibido es aprobadi
              Serial.print("ensendido");
              digitalWrite(led_exi,HIGH);
              digitalWrite(analogInPin,HIGH);
              //Serial.println("led prendido");
              delay(1000);
              digitalWrite(led_exi,LOW );
            } else { //siel cuerpo resibido es denegado
              digitalWrite(led_denegado,HIGH);
              delay(1000);
              digitalWrite(led_denegado,LOW);
            }
          digitalWrite(analogInPin,LOW);
          }
        } else { //error al enviar el pos
          Serial.print("Error enviando POST, código: ");
          Serial.println(codigo_respuesta);//si temuestra en el monitor serial -1 es que no sea enviado
          digitalWrite(led_denegado,HIGH);
          delay(1000);
          digitalWrite(led_denegado,LOW);
        }
        http.end();  //libero recursos
      } else {
        //Serial.println("Error en la conexión WIFI");
      
      }
      delay(2000);
      mfrc522.PICC_HaltA();//detiene el rfid paraque no este  constantemente revisando
    }
  }
}
