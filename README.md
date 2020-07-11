# HotelManagementSystem

Problem Statement

The hotel management system is developed for automating the activities
of a hotel in an efficient way. The system will be a great relief to the
employees and customers both. This system will help users to search
information and to book rooms, events and cinema seats.
This project is used by two types of users which are online users and
Administrator (management of the hotel). Online users can see the
required articles or news and can book. Administrator, who must be an
authorized user, can maintain daily updates in the hotel records.
 

Purpose

The aim of the hotel management system is to provide faster data access
and to allow addition, modification and deletion of data in a very
systematic way and reliable manner. The system will provide solutions for
the problems current manual system is facing. The development of this
new system contains the following activities:
1. It maintains employees’ personal information, address, and contact
details.
2. It makes the overall project management much easier and flexible.
3. Authentication is provided by this application. Only registered users
can access it.



Objective

 
A computer based management system is designed to handle all the
primary information required to calculate monthly statements. Separate
database is maintained to handle all the details required for the correct
statement calculation and generation. This project intends to introduce
more user friendliness in the various activities such as record updation,
maintenance, and searching. The searching of record has been made
quite simple as all the details of the customer can be obtained by simply
keying in the identification of that customer.
Similarly, record maintenance and updation can also be accomplished by
using the identification of the customer with all the details being
automatically generated. These details are also being promptly
automatically updated in the master file thus 1eeping the record
absolutely up-to-date. The entire information has maintained in the
database or Files and whoever wants to retrieve cannot retrieve, only
authorization user can retrieve the necessary information which can be
easily be accessible from the file.
 The main objective of the entire activity is to automate the process of
day to day activities of hotel like room reservation, event room
reservation, authorizing of a new user, checkout of a computer and
releasing the room, finally compute the bill, advance online bookings,
feedbacks etc.
SCOPE OF THE SYSTEM
The system will cover booking a room. Moreover, the system provide
reservation for an event or a cinema seat. Also, not to forget the
additional facilities information that will be efficiently handled by the
system. To help the system smoothly carry out its intended purpose to

meet the hotel management needs, the following tables will be used to
store data. 
Room booking table(bookid, checkin, checkout, no_of_days, total_prices)
 The table is connected with guest_details table (gid, name, phoneno,
email) that will be input when the guest books a room in the hotel. For
booking, the system provides three options which are for online booking,
personal visit to the booking office or telephone calls. For online booking,
the guest will have to visit on to the hotel’s website and select the
checkin and checkout dates. The check in date has constraint that it
would be equal or greater than the current date. The checkout date has
constraint that it would be would be equal or greater than the current
and checkout date.
If the room is available then he can chooses what type of room he wants
which is in the room type table (typeid, type, price, adults, children). Then
he can fill his personal details in the booking web page provided by the
system. For telephone call the guest provides his personal details over
the phone as the hotel’s booking staff do the actual entry of the details
into the system. For personal visit to the hotel, the guest provides his
details verbally which the booking staff enters into the computer system.
Event booking table (bookid, checkin, checkout, total_days, total_price)
 The table is connected with guest_details table (gid, name, phoneno,
email) that will be input when the guest books room for an event in the
hotel. For booking, the system provides three options which are for
online booking, personal visit to the booking office or telephone calls. For
online booking, the guest will have to visit on to the hotel’s website and
select the checkin and checkout dates. The check in date has constraint
that it would be equal or greater than the current date. The checkout

date has constraint that it would be would be equal or greater than the
current and checkout date.
If the event room is available then he can chooses what type of event
room he wants which is in the event room type table (typeid, type, price,
space). Then he can fill his personal details in the booking web page
provided by the system. For telephone call the guest provides his
personal details over the phone as the hotel’s booking staff do the actual
entry of the details into the system. For personal visit to the hotel, the
guest provides his details verbally which the booking staff enters into the
computer system.
Cinema booking table(bookid, date, price, seat_no)
For cinema seat booking, the system provides three options which are for
online booking, personal visit to the booking office or telephone calls. For
all booking options, the guest will have to select the checkin and
checkout dates. The check in date has constraint that it would be equal or
greater than the current date. The checkout date has constraint that it
would be would be equal or greater than the current and checkout date.
If the room is available then he can chooses what type of cinema seat he
wants which is in the cinema type table (typeid, type, price, total_seats)
and book it.
Report table (revenue, expenditure, profit, mont_year)
This table calculates profit by profit = revenue – expenditure. Revenue
comes from revenue table(bill_id, price, date) and expenditure comes
from expenditure table (bill_id, price, date).
