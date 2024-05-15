# Swift Logistics
> Canada-wide logistical corporation project

## Table of Contents
* [General Info](#general-information)
* [Technologies Used](#technologies-used)
* [Features](#features)
* [To Start the Project](#To-Start-the-Project)
* [Usage](#usage)
* [Room for Improvement](#room-for-improvement)
* [Acknowledgements](#acknowledgements)


## General Information
The domain of our project models a logistical company called Swift Shipping Ltd.
Our database will store information regarding company employees, locations,
vehicles, customers, and parcels.

Our database models details about parcel information such as current location,
destination, owner, etc. Moreover, it will also store information about employees
including their role, and the location they work at. Additionally, it will also store
customer details including their name, address, contact details, payment
information, etc. Customers can get their parcel shipped using either standard or
express shipping.


## Technologies Used
- PHP
- MySQL
- HTML
- CSS
- JavaScript


## Features

  ### Customers can:
      ○ sign-up by making a new account on the website.
      ○ Log in to their existing account.
      ○ Customer can update his personal information.
      ○ Request a parcel shipment within Canada.
      ○ Can put the delivery address of the parcel.
      ○ Can input parcel details such as height, weight, and length
      ○ Track their parcel online.

  ### Employees can:
      ○ Log in to their existing account provided by IT/backend.
      ○ All employees can see the delivery status of the shipment
      ○ Combine different tables to get information
      ○ Filter out shipments with specific dimensions
      ○ Employee can see the company’s reports-
        ■ Average order price by province
        ■ Order with an amount greater than province average order price
        ■ Get the lists of customers filtered by order types such as standard
          or expedited

  ### Manager can:
      ○ Manager can do everything that an employee can do.
      ○ See employees' information.
      ○ Delete Orders from the database.


## To Start the Project
    ○ Config.php needs to be edited.
    ○ If your default password for phpMyAdmin is not “root”, please do change it in config.php.
    ○ If you are not using the default port for mySQL, then uncomment the lines and enter your port.


## Placing an Order
  1. The customer has to enter the address where they wish to send the parcel.
  2. The customer then enters the weight and dimensions of the parcel.
  3. A couple of shipping options (i.e. standard or expedited) are then provided to the
      customers.
  4. Lastly, the customer completes the payment, by placing the order.
