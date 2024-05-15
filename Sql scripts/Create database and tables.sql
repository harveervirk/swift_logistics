-- Create database swift_logisctics
CREATE DATABASE Swift_Logistics;

USE
    swift_logistics;                                                                                                                                                                                           
    
CREATE TABLE Customer_Address(
    Postal_Code CHAR(10),
    City CHAR(30),
    Province CHAR(20),
    Country CHAR(20),
    PRIMARY KEY(Postal_Code)
); 

CREATE TABLE Customer(
    Email CHAR(30),
    First_Name CHAR(20) NOT NULL,
    Last_Name CHAR(20),
    Street_Address CHAR(30),
    Postal_Code CHAR(10),
    PASSWORD CHAR(100) NOT NULL,
    Phone CHAR(14) NOT NULL,
    PRIMARY KEY(Email),
    FOREIGN KEY(Postal_Code) REFERENCES Customer_Address(Postal_Code)
);

CREATE TABLE Payment(
Payment_ID Char(30),
Amount Float(14),
Type Char(30),
Primary Key(Payment_ID)
);

CREATE TABLE `Order`(
Order_ID Char(30),
Email Char(30) NOT NULL,
Payment_ID Char(30) NOT NULL UNIQUE,
Qty Int(5),
Order_Date Date,
Primary Key (Order_ID),
Foreign Key(Email) References Customer(Email) ON DELETE NO ACTION,
Foreign Key(Payment_ID) References Payment(Payment_ID) ON DELETE NO ACTION
);


CREATE TABLE Shipment_Address(
Postal_Code Char(7),
City Char(30),
Province Char(30),
Country Char(30),
Primary Key(Postal_Code)
);

CREATE TABLE Employee_Role(
Job_Title Char(30),
Is_Manager Boolean,
Primary Key(Job_Title)
);


CREATE TABLE Location(
Location_ID Int(30),
Name Char(30),
Address Char(100) UNIQUE NOT NULL,
Primary Key(Location_ID)
);



-- We can take out the phone as not null
CREATE TABLE Employee(
Emp_ID Int(30),
Location_ID Int(30),
First_name Char(30) NOT NULL,
Last_Name Char(30) NOT NULL,
Email Char(30) UNIQUE NOT NULL,
Password Char(100),
Job_Title Char(30),
Is_Active Boolean,
Phone Char(14) NOT NULL,
Primary Key(Emp_ID),
Foreign Key(Location_ID) References Location(Location_ID),
Foreign Key(Job_Title ) References Employee_Role(Job_Title)
);

CREATE TABLE Vehicle(
Vin_Number Char(30),
Current_Loc Char(30),
Make Char(30),
Model Char(30),
Lic_Plate_Number Char(10) UNIQUE,
Primary Key(Vin_Number)
);

CREATE TABLE Shipment(
Ref_ID Char(30),
Order_ID Char(30) NOT NULL,
Emp_ID Int(30),
First_Name char(20) NOT NULL,
Last_Name char(20),
Weight Float(6) NOT NULL,
Length Float(4) NOT NULL,
Width Float(4) NOT NULL,
Height Float(4) NOT NULL,
Price Float(30) NOT NULL,
Type Char(30),
Street_Address Char(30),
Postal_Code Char(7) NOT NULL,
Primary Key(Ref_ID),
Foreign Key(Order_ID) References `Order`(Order_ID) ON DELETE CASCADE,
Foreign Key(Emp_ID) References Employee(Emp_ID) ON DELETE NO ACTION,
Foreign Key(Postal_Code) References Shipment_Address(Postal_Code)
);

CREATE TABLE DeliveryPersonnel(
Emp_ID Int(30),
Driver_Lic_No Int(10) NOT NULL,
Primary Key (Emp_ID),
Foreign Key(Emp_ID) References Employee(Emp_ID)
);


-- //Add script for delivery status
CREATE TABLE DeliveryStatus
(Stage_ID Int(3),
Ref_ID Char(30),
Location_ID Int(30),
Vin_number Char(30) ,
Status Char(100),
`Date` Date,
`Time` Time,
Primary Key(Stage_ID, Ref_ID),
Foreign Key(Ref_ID) References Shipment(Ref_ID) ON DELETE CASCADE,
Foreign Key(Location_ID) References Location(Location_ID),
Foreign Key(Vin_Number) References Vehicle(Vin_Number)
);

INSERT INTO Customer_Address values('V2S-2Z8', 'Abbotsford', 'BC', 'Canada');
INSERT INTO Customer_Address values('L3Y-8Y7', 'Newmarket', 'ON', 'Canada');
INSERT INTO Customer_Address values('R2P-1K2', 'Winnipeg', 'MB', 'Canada');
INSERT INTO Customer_Address values('V2S-8K1', 'Abbotsford', 'BC', 'Canada');
INSERT INTO Customer_Address values('V3T-0L4', 'Regina', 'BC', 'Canada');
INSERT INTO Customer_Address values('V2T-4K1', 'Surrey', 'BC', 'Canada');
INSERT INTO Customer_Address values('E7R-T1Y', 'Toronto', 'ON', 'Canada');


INSERT INTO Customer values('anne23@gmail.com', 'Anne', 'Bells', '1865 Jackson
Street', 'V2S-2Z8', 'Anne123@', '(236) 996-1231');
INSERT INTO Customer values('raj87@gmail.com', 'Raj', 'Sharma', '2397 Gorham
Street', 'L3Y-8Y7', 'NoPassword567', '(647) 897-4545');
INSERT INTO Customer values('Imran46@gmail.com', 'Imran', 'Khan', '102 311
Mandalay Drive', 'R2P-1K2', 'ForgotPass', '(204) 369-1972');
INSERT INTO Customer values('jennifer_kaur@gmail.com', 'Jennifer', 'Kaur', '1812
Vedder Way', 'V2S-8K1', 'IamJennifer909', '(604) 852-3456');
INSERT INTO Customer values('amandalavern236@gmail.com', 'Amanda', 'Lavern',
'2751 Rose St.', 'V3T-0L4', 'helloAmanda236', '(639) 781-8432');
INSERT INTO Customer values('mandybhullar@gmail.com', 'Mandy', 'Bhullar',
'236 Cabella St.', 'V2T-4K1', 'mandybhullar236', '(236) 887-1239');
INSERT INTO Customer values('adriananelson@gmail.com', 'Adriana', 'Nelson',
'987 Kirk Ave.', 'E7R-T1Y', 'adriana55@', '(403) 852-4569');

INSERT INTO Payment values('1000000001', '39.85', 'Visa');
INSERT INTO Payment values('1000000002', '25.10', 'Visa');
INSERT INTO Payment values('1000000003', '20.00', 'Visa'); 
INSERT INTO Payment values('1000000004', '35.45', 'Visa');
INSERT INTO Payment values('1000000005', '22.50', 'Visa');

INSERT INTO `Order` values('1', 'raj87@gmail.com', '1000000001', '2', '2022-02-18');
INSERT INTO `Order` values('2', 'Imran46@gmail.com', '1000000002', '1', '2022-01-05');
INSERT INTO `Order` values('3', 'anne23@gmail.com', '1000000003', '1', '2022-04-30');
INSERT INTO `Order` values('4', 'amandalavern236@gmail.com', '1000000004', '1', '2021-12-27');
INSERT INTO `Order` values('5', 'jennifer_kaur@gmail.com', '1000000005', '1', '2022-06-19');

INSERT INTO Shipment_Address values('V5M-4X5', 'Vancouver', 'BC', 'Canada');
INSERT INTO Shipment_Address values('T3R-1N3', 'Calgary', 'AB', 'Canada');
INSERT INTO Shipment_Address values('V3W-3N1', 'Surrey', 'BC', 'Canada');
INSERT INTO Shipment_Address values('V3S-7K9', 'Surrey', 'BC', 'Canada');
INSERT INTO Shipment_Address values('T3A-5K2', 'Calgary', 'AB', 'Canada');
INSERT INTO Shipment_Address values('V6E-1L3', 'Vancouver', 'BC', 'Canada');
INSERT INTO Shipment_Address values('L4E-4J3', 'Richmond Hill', 'ON', 'Canada');

INSERT INTO Employee_Role values('Driver', 0);
INSERT INTO Employee_Role values('Manager', 1);
INSERT INTO Employee_Role values('Warehouse Worker', 0);
INSERT INTO Employee_Role values('Sanitation Manager', 1);
INSERT INTO Employee_Role values('Security Guard', 0);

INSERT INTO Location values('45', 'Vancouver Warehouse', '2151 Canada Drive, Vancouver, BC, V5L-0A1');
INSERT INTO Location values('36', 'Toronto Warehouse', '5698 Tims Street, Toronto, ON, M4C-1B2');
INSERT INTO Location values('22', 'Montreal Loc', '325 Old Road, Montreal, QB, H1L-2K1');
INSERT INTO Location values('12', 'Calgary Warehouse', '23 Kincora Drive NE, Calgary, AB, T2M-9B5');
INSERT INTO Location values('23', 'Winnipeg Loc', '456 Roxwood Place, Winnipeg, MB, R2P-1K9');

INSERT INTO Vehicle values('WDDLJ7EB5CA027308', 'At loc: 45', 'Mercedes-Benz',
'Sprinter Crew Van', 'LP7 47G');
INSERT INTO Vehicle values('WDDEJ7EB0CA028665', 'Out for delivery', 'Mercedes-Benz',
'Actros L', 'M41 A7K');
INSERT INTO Vehicle values('WDDGF8AB2DA744412', 'In transit to Loc: 36', 'Ford',
'Cargo Van', 'NN1 67C');
INSERT INTO Vehicle values('4JGBF22E28A298970', 'At Loc: 22', 'Mercedes-Benz',
'Sprinter Crew Van', '9YU 56X');
INSERT INTO Vehicle values('WDBEA52E0PC000113', 'At Loc: 12', 'Ford', 'F-750', '78H
PN2');

INSERT INTO Employee values('1001', '36', 'Mark', 'Robert', 'mrobert12@hotmail.com',
'799ILoveThisCompany@@', 'Driver', True, '(604) 897-1254');
INSERT INTO Employee values('1354', '45', 'Jack', 'Neil', 'NeilJack3@gmail.com',
'IamJack34!', 'Driver', True, '(236) 496-1486');
INSERT INTO Employee values('1532', '22', 'Harpreet', 'Sidhu', 'hpsingh@yahoo.com',
'CalgaryCanada2019$$', 'Driver', True, '(204) 396-2890');
INSERT INTO Employee values('1298', '12', 'Usman', 'Ali', 'usmanahmed52@gmail.com',
'AlialiUsman1234!', 'Driver', True, '(413) 568-1200');
INSERT INTO Employee values('3921', '45', 'Rick', 'White', 'whiter604@gmail.com',
'6042584563', 'Driver', True, '(604) 258-4563');
INSERT INTO Employee values('9685', '12', 'Steven', 'Garden', 'stgr@hotmail.com',
'SwiftPassword4321', 'Manager', True, '(672) 458-4547');
INSERT INTO Employee values('9632', '45', 'Olivia', 'Watson',
'oliviawatson678@gmail.com', 'OliviaCool3434', 'Warehouse Worker', False, '(204) 696-1598');
INSERT INTO Employee values('1', NULL, 'Online', 'User',
'OnlineUser@swiftlogistics.com', '12345', NULL, True, '(244) 696-1458');

INSERT INTO Shipment values('101', '1', '1001', 'Jack', 'Nelson', '5.36', '4.5', '4.4', '3.6', '19.85', 'Express',
'2925 Virtual Way', 'V5M-4X5');
INSERT INTO Shipment values('102', '1', '1001', 'Jack', 'Nelson', '8.5', '3.3', '5.7', '4.3', '20.00', 'Express',
'2925 Virtual Way', 'V5M-4X5');
INSERT INTO Shipment values('201', '2', '1354', 'Anile', 'Bhardwaj', '2.3', '6.3', '5.12', '9.3', '25.10', 'Standard',
'10 Kincora Heights NW', 'T3R-1N3');
INSERT INTO Shipment values('301', '3', '1532', 'Rajesh', 'Kakkar', '3.7', '3.12', '4.8', '7.3', '20.00', 'Standard',
'201 - 7500 120 St', 'V3W-3N1');
INSERT INTO Shipment values('401', '4', '1354', 'Betty', 'Baker', '4.0', '6.8', '4.1', '5.9', '21.15', 'Standard',
'64 Hidden Spring Close NW', 'T3A-5K2');
INSERT INTO Shipment values('501', '5', '3921', 'Himesh', 'Sharma', '9.1', '15.3', '15.3', '39', '22.50', 'Standard', 
'81 Ravine Edge Dr', 'L4E-4J3');

INSERT INTO DeliveryPersonnel values('1001', '37893114');
INSERT INTO DeliveryPersonnel values('1354', '78925412');
INSERT INTO DeliveryPersonnel values('1532', '95175385');
INSERT INTO DeliveryPersonnel values('1298', '26841574');
INSERT INTO DeliveryPersonnel values('3921', '39172864');

INSERT INTO DeliveryStatus values('1', '101', NULL, NULL, 'Order placed',
'2022-02-19', '13:06:55');
INSERT INTO DeliveryStatus values('1', '102', NULL, NULL, 'Order placed',
'2022-01-06', '13:06:55');
INSERT INTO DeliveryStatus values('2', '101', '36', NULL, 'Shipment in process',
'2022-02-19', '18:23:41');
INSERT INTO DeliveryStatus values('2', '102', '36', NULL, 'Shipment in process',
'2022-02-19', '18:25:27');
INSERT INTO DeliveryStatus values('3', '101', NULL, NULL, 'In Transit', 
'2022-02-20', '06:47:39');
INSERT INTO DeliveryStatus values('3', '102', NULL, NULL, 'In Transit', 
'2022-02-20', '06:48:30');
INSERT INTO DeliveryStatus values('1', '201', '23', NULL, 'Order placed',
'2022-01-05', '11:26:13');
INSERT INTO DeliveryStatus values('4', '101', '45', NULL, 'Arrived at Location: Vancouver', 
'2022-02-20', '10:13:56');
INSERT INTO DeliveryStatus values('4', '102', '45', NULL, 'Arrived at Location: Vancouver', 
'2022-02-20', '10:15:42');
INSERT INTO DeliveryStatus values('2', '201', '23', NULL, 'Shipment in process',
'2022-05-08', '15:19:49');
INSERT INTO DeliveryStatus values('5', '101', NULL, 'WDDLJ7EB5CA027308', 'Out For Delivery', 
'2022-02-20', '12:23:07');
INSERT INTO DeliveryStatus values('5', '102', NULL, 'WDDLJ7EB5CA027308', 'Out For Delivery', 
'2022-02-20', '12:23:59');
INSERT INTO DeliveryStatus values('1', '301', NULL, NULL, 'Order placed',
'2022-04-30', '19:19:19');
INSERT INTO DeliveryStatus values('2', '301', '45', NULL, 'Shipment in progress',
'2022-05-02', '08:01:48');
INSERT INTO DeliveryStatus values('6', '101', NULL, 'WDDLJ7EB5CA027308', 'Delivered', 
'2022-02-20', '01:05:11');
INSERT INTO DeliveryStatus values('6', '102', NULL, 'WDDLJ7EB5CA027308', 'Delivered', 
'2022-02-20', '01:05:30');
INSERT INTO DeliveryStatus values('1', '401', NULL, NULL, 'Order placed',
'2021-12-27', '09:17:36');

CREATE TRIGGER Delivry_Status_On_Order_Placed 
AFTER INSERT
ON Shipment
FOR EACH ROW 
INSERT INTO deliverystatus (Stage_ID, Ref_ID, Location_ID, Vin_number, Status, Date, Time)
    		VALUES('1', NEW.Ref_ID, NULL, NULL, 'Order Placed', curdate(), CURRENT_TIME());