//String mac=WiFi.macAddress();
const int analogInPin = A0;
int val = 0;
String dato;
int PosicionComa; //Variable que nos dice la posicion de la coma en el mensaje.
#include <Servo.h>//libreria para los servos 
Servo servo1;//declara los servos
#include <LiquidCrystal_I2C.h>
int lcdColumns = 16;
int lcdRows = 2;
LiquidCrystal_I2C lcd(0x27, lcdColumns, lcdRows);
#include <SPI.h>//libreria nesesaria para el rfid
#include <MFRC522.h>
#define SS_PIN 2//definendopin delrfid
#define RST_PIN 4
int led_verde = 1; ///pin del led
int buzer = 3; //pin del buzer
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
char* ssid = "Magic_red";
const char* password =  "12345678";
String user ;//dato que  enviaremos en post
String pass = "12345";
void setup() {
  pinMode(A0, INPUT);
  SPI.begin();       // Init SPI bus
  mfrc522.PCD_Init(); // Init MFRC522
  //  Serial.println("RFID reading UID");
  // initialize LCD
  lcd.init();
  // turn on LCD backlight
  lcd.backlight();
  lcd.home();
  servo1.attach(15);
  servo1.write(0);
  delay(10);
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  //definiendo entradas y salidas
  pinMode(16, OUTPUT);
  pinMode(led_verde, OUTPUT);
  pinMode(buzer, OUTPUT);
  digitalWrite(16, HIGH);
  Serial.print("Conectando...");
  lcd.print("Conectando...");
  while (WiFi.status() != WL_CONNECTED) { //Check for the connection
    delay(500);
    Serial.print(".");
  }
  lcd.clear();
  lcd.print("inserte tarjeta");
  Serial.print("Conectado con éxito, mi IP es: ");
  Serial.println(WiFi.localIP());
}
void loop() {
  val = analogRead(analogInPin);
  if (val >= 1000) {
    lcd.clear();
    lcd.print("saliendo");
    digitalWrite(16, LOW);
    delay(500);
    servo1.write(90);
    delay(3500);
    for(int i=90;i>=0;i--){
      servo1.write(i);
      delay(30);
    }
    digitalWrite(16, HIGH);
    lcd.clear();
   lcd.print("introdusca targeta");
  }
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
        //http.begin("http://172.16.84.200/rfid/checklogin.php");        //Indicamos el destino
        http.begin("http://192.168.0.6/acceso/Model/arduino/entrada.php");        //Indicamos el destino
        http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Preparamos el header text/plain si solo vamos a enviar texto plano sin un paradigma llave:valor.
        int codigo_respuesta = http.POST(datos_a_enviar);   //Enviamos el post pasándole, los datos que queremos enviar. (esta función nos devuelve un código que guardamos en un int)
        if (codigo_respuesta > 0) {
           Serial.println("Código HTTP ► " + String(codigo_respuesta));   //Print return code
          if (codigo_respuesta == 200) { //si la conexion fue esitosa
            String cuerpo_respuesta = http.getString();
            Serial.println("El servidor respondió ▼ ");
             Serial.println(cuerpo_respuesta);
         //   PosicionComa = cuerpo_respuesta.indexOf (',');
            //Serial.println (cuerpo_respuesta.substring (0, PosicionComa));
           // cuerpo_respuesta = cuerpo_respuesta.substring (PosicionComa + 1, cuerpo_respuesta.length());
           cuerpo_respuesta.trim();
           Serial.println(cuerpo_respuesta);
            if (cuerpo_respuesta == "aprobado") { //siel cuerpo resibido es aprobadi
              //  Serial.println("confirmacion aprobada pase");
              digitalWrite(16, LOW);
              lcd.clear();
              lcd.setCursor(0, 0);
              lcd.print(cuerpo_respuesta);
              digitalWrite(buzer, HIGH);
              digitalWrite(led_verde, HIGH);
              servo1.write(90);
              tone(buzer, 622.25);
              delay(600);
              noTone(buzer);
              digitalWrite(led_verde, LOW);
              delay(4000);
              servo1.write(0);
              digitalWrite(16, HIGH);
            } else { //siel cuerpo resibido es denegado
              noTone(buzer);
              lcd.clear();
              lcd.print(cuerpo_respuesta);
              digitalWrite(led_verde, LOW);
              digitalWrite(16, HIGH);
              tone(buzer, 622.25);
              delay(600);
              noTone(buzer);
              delay(500);
              tone(buzer, 622.25);
              delay(600);
              noTone(buzer);
              // Serial.print(user);
            }
            lcd.clear();
            lcd.print("inserte tarjeta");
          }
        } else { //error al enviar el pos
          //Serial.print("Error enviando POST, código: ");
          //Serial.println(codigo_respuesta);//si temuestra en el monitor serial -1 es que no sea enviado
          lcd.clear();
          lcd.print("Error en POST");
        }
        http.end();  //libero recursos
      } else {
        //Serial.println("Error en la conexión WIFI");
        lcd.clear();
        lcd.print("Error conexión");
      }
      delay(2000);
      mfrc522.PICC_HaltA();//detiene el rfid paraque no este  constantemente revisando
    }
  }
}

