#include <paulvha_SCD30.h>
#include <HTTPClient.h>
#include "WiFi.h"
#include <TFT_eSPI.h>

TFT_eSPI tft = TFT_eSPI();

int16_t h = 128;
int16_t w = 160;

const char* ssid1 = "";
const char* password1 = "";

const char* ssid2 = "";
const char* password2 = "";

const char* ssid3 = "";
const char* password3 = "";

String serverName = "http://api.allthingstalk.io";

char token[] = "";

WiFiClient connection;

#define SCD30WIRE Wire

SCD30 airSensor;

void setup()
{
  tft.init();
  tft.fillScreen(TFT_BLACK);
  tft.setCursor(0, 0, 4);
  tft.setTextColor(TFT_WHITE, TFT_BLACK);
  tft.setRotation(1);

  Serial.begin(115200); // Opening the Serial port

  WiFi.begin(ssid1, password1); // Begin WiFi operation
  WiFiConnect(ssid1, password1);// Call WiFiConnection function called, connecting to WiFi network
  if (WiFi.status() != WL_CONNECTED) {
    WiFi.begin(ssid2, password2); // Begin WiFi operation
    WiFiConnect(ssid2, password2);
    if (WiFi.status() != WL_CONNECTED) {
      WiFi.begin(ssid3, password3); // Begin WiFi operation
      WiFiConnect(ssid3, password3);
    }
  }

  SCD30WIRE.begin(0x61); // Begin Sensor
  if (! airSensor.begin(SCD30WIRE))
  {
    tft.println("Sensor:");
    tft.println("failed!");
    tft.setTextColor(TFT_RED, TFT_BLACK);
    tft.println("reset device");
    Serial.println(F("The SCD30 did not respond. Please check wiring.")); // Announce that sensor couldnt start and hold cpu
    while (1);
  }




  delay(5000);
}

int disconnectedtime = 0;
int count = 0;
void loop()
{
  if (airSensor.dataAvailable())
  {
    debugWrite("(SENSOR) Data received");
    
    int co2 = airSensor.getCO2();
    float temp = airSensor.getTemperature();
    float humid = airSensor.getHumidity();
    
    Serial.print("(SENSOR) co2(ppm):");
    Serial.print(co2);

    Serial.print(" temp(C):");
    Serial.print(temp, 1);

    Serial.print(" humidity(%):");
    Serial.print(humid, 1);

    Serial.println();

    tft.drawString("                                                     ", 4, 50 , 4);
    tft.drawString("CO2 (ppm): " + String(co2), 4, 40 , 4);
    tft.drawString("                                             ", 4, 60 , 2);
    tft.drawString("Temp (C): " + String(temp) + " Humid (%): " + String(humid), 4, 85 , 2);

    if (count > 4) {
      if (WiFi.status() != WL_CONNECTED) {
        Serial.println("(WIFI) Device is offline thus it cannot update ATT, restart to retry connecting"); // Announcing connection fail
      } else {
        Serial.println("(HTTP) Updating sensors on ATT");
        debugWrite("(HTTP) Updating ATT");
        ATTUpdate(co2, temp, humid);
        count = 0;
      }
    }
  }
  else {
    Serial.println("(SENSOR) No data");
    debugWrite("(SENSOR) No data");
  }
  
  delay (2000);
  count++;
}

void ATTUpdate( int co2, float temp, float humid) // Update the sensor on the AllThingsTalk ground
{

  String tokenstring = String(token);
  HTTPClient http; // Initiate http client
  http.useHTTP10(true);
  String serverPath = "";
  int httpResponseCode = 0;

  //update the CO2 value
  serverPath = serverName + "/asset/asset_id/state"; // Set the serverpath to the full path
  http.begin(serverPath.c_str()); // Start the http client at the specified serverpath

  http.addHeader("Authorization", "Bearer " + tokenstring);
  http.addHeader("Content-Type", "application/json");

  String co2toup = String(co2);
  httpResponseCode = http.PUT("{ \"value\": " + co2toup + " }");
  Serial.print("(HTTP) Responsecode for PUT request (CO2): ");
  debugWrite("(HTTP) CO2 response: " + String(httpResponseCode));
  Serial.print(httpResponseCode);

  if (httpResponseCode == 200) {
    Serial.println(", succes!");
  } else {
    Serial.println(", failed!");
  }
  http.end();

  //update the temperature value
  serverPath = serverName + "/asset/asset_id/state"; // Set the serverpath to the full path
  http.begin(serverPath.c_str()); // Start the http client at the specified serverpath

  http.addHeader("Authorization", "Bearer " + tokenstring); // Add the authorization header with the device token
  http.addHeader("Content-Type", "application/json");

  String temptoup = String(temp);
  httpResponseCode = http.PUT("{ \"value\": " + temptoup + " }");
  Serial.print("(HTTP) Responsecode for PUT request (Temperature): ");
  debugWrite("(HTTP)temp response: " + String(httpResponseCode));
  Serial.print(httpResponseCode);

  if (httpResponseCode == 200) {
    Serial.println(", succes!");
  } else {
    Serial.println(", failed!");
  }
  http.end();

  //update the humidity value
  serverPath = serverName + "/asset/asset_id/state"; // Set the serverpath to the full path
  http.begin(serverPath.c_str()); // Start the http client at the specified serverpath

  http.addHeader("Authorization", "Bearer " + tokenstring); // Add the authorization header with the device token
  http.addHeader("Content-Type", "application/json");

  String humidtoup = String(humid);
  httpResponseCode = http.PUT("{ \"value\": " + humidtoup + " }");
  Serial.print("(HTTP) Responsecode for PUT request (Humidity): ");
  debugWrite("(HTTP)humid response: " + String(httpResponseCode));
  Serial.print(httpResponseCode);

  if (httpResponseCode == 200) {
    Serial.println(", succes!");
  } else {
    Serial.println(", failed!");
  }
  http.end();
}

void WiFiConnect(const char* ssid, const char* password) { // Function that connects to the wifi network
  int count = 0;
  while (count != 10) { // Holding until the wifi has been connected
    delay(500);
    Serial.print("(WIFI) Trying to connect to: ");
    Serial.println(ssid);
    tft.drawString("                                                ", 4, 4 , 2);
    tft.drawString("(WiFi) Connecting (" + String(count) + "): " + String(ssid), 4, 4 , 2);

    if (WiFi.status() == WL_CONNECTED) {
      Serial.print("(WIFI) Connected to "); // Announcing succesful connection
      Serial.println(ssid);
      tft.drawString("                                                ", 4, 4 , 2);
      tft.drawString("(WiFi) Connected: " + String(ssid), 4, 4 , 2);
      debugWrite(" ");
      break;
    }

    count++;

    delay(100);
  }

  if (WiFi.status() != WL_CONNECTED) {
    Serial.print("(WIFI) Failed to connect to "); // Announcing connection fail
    Serial.print(ssid);
    Serial.println(", starting offline operation... (reset to retry)");

    tft.drawString("                                                ", 4, 4 , 2);
    tft.setTextColor(TFT_RED);
    tft.drawString("(WiFi) Offline", 4, 4 , 2);
    tft.setTextColor(TFT_WHITE, TFT_BLACK);
    debugWrite(" ");
  }
}

void debugWrite(String msg)
{
  tft.drawString("                                         ", 4, 110 , 2);
  tft.drawString(msg, 4, 110 , 2);
}
