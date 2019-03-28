CREATE TABLE OwnerNameNum
( phoneNum char(10),
name varchar(30),
primary key (phoneNum) );

CREATE TABLE WalkerNameNum
( phoneNum char(10),
name varchar(30),
primary key (phoneNum) );

CREATE TABLE DogOwner
( username VARCHAR(20),
 password VARCHAR(20) NOT NULL,
 userImage VARCHAR(255),
 phoneNum CHAR(10) NOT NULL,
 PRIMARY KEY (username),
 foreign key (phoneNum) references OwnerNameNum(phoneNum) );

CREATE TABLE DogWalker
( username VARCHAR(20),
 password VARCHAR(20) NOT NULL,
 userImage VARCHAR(255),
 phoneNum CHAR(10) NOT NULL,
 personalBio VARCHAR(255),
 walksCompleted integer NOT NULL,
 PRIMARY KEY (username),
 foreign key (phoneNum) references WalkerNameNum(phoneNum) );

CREATE TABLE DogType
( age integer,
breed varchar(20),
size char(1) not null,
primary key (age, breed) );


CREATE TABLE Dog
( name VARCHAR(20),
 age INTEGER NOT NULL,
 gender CHAR(1) NOT NULL,
 breed VARCHAR(20) NOT NULL,
 dogImage VARCHAR(255),
 owner VARCHAR(20),
 PRIMARY KEY (name, owner),
 FOREIGN KEY (owner) REFERENCES DogOwner(username) ON DELETE CASCADE,
 FOREIGN KEY (age, breed) REFERENCES DogType(age, breed) );

CREATE TABLE WalkPost
( owner VARCHAR(20),
 dog VARCHAR(20),
 referenceID INTEGER,
 startLocn VARCHAR(100),
 endLocn VARCHAR(100),
 startTime TIMESTAMP, 
 endTime TIMESTAMP,
 booked BOOLEAN,
 completed BOOLEAN,
 specialRequests VARCHAR(255),
 PRIMARY KEY (referenceID),
 FOREIGN KEY (owner) REFERENCES DogOwner(username) ON DELETE CASCADE,
 FOREIGN KEY (dog) REFERENCES Dog(name) ON DELETE CASCADE );

CREATE TABLE WalkRequest
( walkerID varchar(20),
walkID	integer,  
requestID integer,  
message varchar(255),
confirmed boolean,
PRIMARY KEY (requestID, walkerID, walkID),
FOREIGN KEY (walkerID) REFERENCES DogWalker(username) ON DELETE CASCADE, 
FOREIGN KEY (walkID) REFERENCES WalkPost(referenceID) ON DELETE CASCADE );

CREATE TABLE Review
( writtenBy varchar(20),
writtenFor varchar(20),
reviewID integer,
rating integer,
date timestamp,
comment varchar(255),
primary key (reviewID),
foreign key (writtenBy) references DogOwner(username),
foreign key (writtenFor) references DogWalker(username) );

CREATE TABLE DogMeetupPost
( eventID integer,
dateTime timestamp,
location varchar(100),
postedBy varchar(20),
primary key (eventID),
foreign key (postedBy) references DogOwner(username));
