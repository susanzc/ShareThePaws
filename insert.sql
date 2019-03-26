
INSERT INTO ownerNameNum(Name, phoneNum)
	VALUES ('Alice Margeret', '111-111-1111'),
	('Robert Picton', '222-222-2222'),
	('Carrie Smith', '333-333-3333'),
	('Dillan Thomas', '444-444-4444'),
	('Edgar Wellington', '555-555-5555');

INSERT INTO walkerNameNum(Name, phoneNum)
	VALUES ('Feres Salem', '011-111-1111'),
	('George Renford', '022-222-2222'),
	('Hilda Ostereich', '033-333-3333'),
	('Igrid Smolson', '044-444-4444'),
	('Joseph Aramathia', '055-555-5555');
	
INSERT INTO DogOwner(Username, Password, userImage, PhoneNum)
	VALUES ('alice', 'password', 'alice.jpg', '111-111-1111'),
	('bob', 'password', 'bob.jpg', '222-222-2222'),
	('carrie', 'password', 'carrie.jpg', '333-333-3333'),
	('dillan', 'password', 'dillan.jpg', '444-444-4444'),
	('edger', 'password', 'edger.jpg', '555-555-5555');

INSERT INTO DogWalker(Username, Password, userImage, PhoneNum, personalBio,  WalksCompleted)
	VALUES ('feres', 'password', 'feres.jpg', '011-111-1111', 'Just here to walk some dogs',0),
	('george', 'password', 'george.jpg', '022-222-2222', 'a dog walker', 0),
	('hilda', 'password', 'hilda.jpg', '033-333-3333', 'give me dogs', 1),
	('igrid', 'password', 'igrid.jpg', '044-444-4444', 'i like walks', 1),
	('joe', 'password', 'joe.jpg', '055-555-5555', 'give me walks', 0);

INSERT INTO DogType(age, breed, size)
	VALUES (1, 'golden retriever', 'S'),
	(2, 'golden retriever', 'M'),
	(3, 'golden retriever', 'L'),
	(4, 'golden retriever', 'L'),
	(5, 'golden retriever', 'L'),
	(6, 'golden retriever', 'L'),
	(7, 'golden retriever', 'L'),
	(8, 'golden retriever', 'L'),
	(9, 'golden retriever', 'L'),
	(10, 'golden retriever', 'L'),
	(11, 'golden retriever', 'L'),
	(12, 'golden retriever', 'L'),
	(13, 'golden retriever', 'L'),
	(14, 'golden retriever', 'L'),
	(15, 'golden retriever', 'L'),
	(16, 'golden retriever', 'L'),
	(17, 'golden retriever', 'L'),
	(1, 'corgi', 'S'),
	(2, 'corgi', 'M'),
	(3, 'corgi', 'M'),
	(4, 'corgi', 'M'),
	(5, 'corgi', 'M'),
	(6, 'corgi', 'M'),
	(7, 'corgi', 'M'),
	(8, 'corgi', 'M'),
	(9, 'corgi', 'M'),
	(10, 'corgi', 'M'),
	(11, 'corgi', 'M'),
	(12, 'corgi', 'M'),
	(13, 'corgi', 'M'),
	(14, 'corgi', 'M'),
	(15, 'corgi', 'M'),
	(16, 'corgi', 'M'),
	(17, 'corgi', 'M'),
	(1, 'pomerainian', 'S'),
	(2, 'pomerainian', 'S'),
	(3, 'pomerainian', 'S'),
	(4, 'pomerainian', 'S'),
	(5, 'pomerainian', 'S'),
	(6, 'pomerainian', 'S'),
	(7, 'pomerainian', 'S'),
	(8, 'pomerainian', 'S'),
	(9, 'pomerainian', 'S'),
	(10, 'pomerainian', 'S'),
	(11, 'pomerainian', 'S'),
	(12, 'pomerainian', 'S'),
	(13, 'pomerainian', 'S'),
	(14, 'pomerainian', 'S'),
	(15, 'pomerainian', 'S'),
	(16, 'pomerainian', 'S'),
	(17, 'pomerainian', 'S'),
	(1, 'pit bull', 'S'),
	(2, 'pit bull', 'M'),
	(3, 'pit bull', 'L'),
	(4, 'pit bull', 'L'),
	(5, 'pit bull', 'L'),
	(6, 'pit bull', 'L'),
	(7, 'pit bull', 'L'),
	(8, 'pit bull', 'L'),
	(9, 'pit bull', 'L'),
	(10, 'pit bull', 'L'),
	(11, 'pit bull', 'L'),
	(12, 'pit bull', 'L'),
	(13, 'pit bull', 'L'),
	(14, 'pit bull', 'L'),
	(15, 'pit bull', 'L'),
	(16, 'pit bull', 'L'),
	(17, 'pit bull', 'L'),
	(1, 'husky', 'M'),
	(2, 'husky', 'L'),
	(3, 'husky', 'L'),
	(4, 'husky', 'L'),
	(5, 'husky', 'L'),
	(6, 'husky', 'L'),
	(7, 'husky', 'L'),
	(8, 'husky', 'L'),
	(9, 'husky', 'L'),
	(10, 'husky', 'L'),
	(11, 'husky', 'L'),
	(12, 'husky', 'L'),
	(13, 'husky', 'L'),
	(14, 'husky', 'L'),
	(15, 'husky', 'L'),
	(16, 'husky', 'L'),
	(17, 'husky', 'L');

INSERT INTO Dog(Name, Age, Breed, Gender, dogImage, Owner)
	VALUES ('Rover', 4, 'pit bull', 'M', 'rover.jpg', 'alice'),
	('Spot', 4, 'husky', 'F', 'spot.jpg', 'bob'),
	('Rex', 4, 'pomerainian', 'M', 'rex.jpg',  'carrie'),
	('Fido', 4, 'corgi', 'F', 'fido.jpg', 'dillan'),
	('Rover', 4, 'golden retriever', 'M', 'rover.jpg', 'edger');

INSERT INTO WalkPost(Owner, Dog, referenceID, starttime, startlocn, endtime, endlocn, booked, completed, specialRequests)
	VALUES ('alice', 'Rover', 0, '2020-01-01 09:00:00', 'UBC Vancouver', '2020-01-01 11:00:00', 'UBC Vancouver', 'F', 'F', 'throw ball'),
	('alice', 'Rover', 1, '2020-01-01 12:00:00', 'Vancouver General Hospital', '2020-01-01 14:00:00', 'Central Park', 'F', 'F', 'throw ball'),
	('bob', 'Spot', 2, '2020-01-01 12:00:00', 'Jericho Beach', '2020-01-01 17:00:00', 'UBC Vancouver', 'F', 'F', 'throw frisbee'),
	('dillan', 'Fido', 3, '2020-01-02 14:00:00', 'Kitsilano Beach', '2020-01-01 16:00:00', 'Kitsilano Beach', 'F', 'F', 'run'),
	('carrie', 'Rex', 4, '2020-01-03 10:00:00', 'Spanish Banks', '2020-01-01 17:00:00', 'Spanish Banks', 'F', 'F', 'rub belly');

INSERT INTO WalkRequest(walkerID, walkID, requestID, message, confirmed)
	VALUES ('feres', 0, 3, 'let me walk dogs pls thxs', 'F'),
	('george', 1, 4, 'I am very experienced with doggos', 'F'),
	('hilda', 2, 1, 'like, your dog is rly cute', 'F'),
	('igrid', 3, 8,  'I am here for dog walks', 'F'),
	('joe', 4, 9, 'let me walk dogs pls thxs', 'F');

INSERT INTO Review(writtenBy, writtenFor, reviewID, rating, date, comment)
	VALUES ('alice', 'feres', 0, 4, '2020-01-01 00:08:00', 'pretty chill dude tbh'),
	('alice', 'george', 1, 1, '2020-01-01 00:08:00',  'Not very experienced'),
	('bob', 'hilda', 2, 5, '2020-01-01 00:08:00', 'What a nice lady'),
	('dillan', 'igrid', 3, 1, '2020-01-01 00:08:00', 'Could not keep up with dog'),
	('carrie', 'joe', 4, 5, '2020-01-01 00:08:00', 'Brought treats for dog. Wow');

INSERT INTO DogMeetupPost(EventID, dateTime, location, postedBy)
	VALUES (0, '2020-01-01 08:00:00', 'Jericho Beach', 'edger'),
	(1, '2020-01-02 16:00:00', 'Deer Lake Park', 'alice'),
	(2, '2020-02-01 15:30:00', 'Kitsilano Beach', 'bob'),
	(3, '2020-03-01 12:00:00', 'UBC Vancouver', 'edger'),
	(4, '2020-04-01 13:00:00', 'SFU', 'edger');
