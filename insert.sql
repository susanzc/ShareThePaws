

INSERT INTO ownerNameNum(Name, phoneNum)
	VALUES ('Alice Margeret', '1111111111'),
	('Robert Picton', '2222222222'),
	('Carrie Smith', '3333333333'),
	('Dillan Thomas', '4444444444'),
	('Edgar Wellington', '5555555555');

INSERT INTO walkerNameNum(Name, phoneNum)
	VALUES ('Feres Salem', '0111111111'),
	('George Renford', '0222222222'),
	('Hilda Ostereich', '0333333333'),
	('Igrid Smolson', '0444444444'),
	('Joseph Aramathia', '0555555555');

INSERT INTO DogOwner(Username, Password, userImage, PhoneNum)
	VALUES ('alice', 'password', 'alice.jpg', '1111111111'),
	('bob', 'password', 'bob.jpg', '2222222222'),
	('carrie', 'password', 'carrie.jpg', '3333333333'),
	('dillan', 'password', 'dillan.jpg', '4444444444'),
	('edger', 'password', 'edger.jpg', '5555555555');

INSERT INTO DogWalker(Username, Password, userImage, PhoneNum, personalBio,  WalksCompleted)
	VALUES ('feres', 'password', 'feres.jpg', '0111111111', 'Just here to walk some dogs',0),
	('george', 'password', 'george.jpg', '0222222222', 'a dog walker', 0),
	('hilda', 'password', 'hilda.jpg', '0333333333', 'give me dogs', 1),
	('igrid', 'password', 'igrid.jpg', '0444444444', 'i like walks', 1),
	('joe', 'password', 'joe.jpg', '0555555555', 'give me walks', 0);

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
	('Dover', 1, 'pit bull', 'M', 'dover.jpg', 'alice'),
	('Spot', 4, 'husky', 'F', 'spot.jpg', 'bob'),
	('Rex', 4, 'pomerainian', 'M', 'rex.jpg',  'carrie'),
	('Fido', 4, 'corgi', 'F', 'fido.jpg', 'dillan'),
	('Teddy', 4, 'golden retriever', 'M', 'rover.jpg', 'edger');

INSERT INTO WalkPost(Owner, Dog, referenceID, starttime, startlocn, endtime, endlocn, booked, completed, specialRequests)
	VALUES ('alice', 'Rover', 0, '2020-01-01 09:00:00', 'UBC Vancouver', '2020-01-01 11:00:00', 'UBC Vancouver', 0, 0, 'throw ball'),
	('alice', 'Dover', 1, '2020-01-01 12:00:00', 'Vancouver General Hospital', '2020-01-01 14:00:00', 'Central Park', 0, 0, 'throw rope'),
	('bob', 'Spot', 2, '2020-01-01 12:00:00', 'Jericho Beach', '2020-01-01 17:00:00', 'UBC Vancouver', 0, 0, 'throw frisbee'),
	('dillan', 'Fido', 3, '2020-01-02 14:00:00', 'Kitsilano Beach', '2020-01-01 16:00:00', 'Kitsilano Beach', 0, 0, 'run'),
	('carrie', 'Rex', 4, '2020-01-03 10:00:00', 'Spanish Banks', '2020-01-01 17:00:00', 'Spanish Banks', 0, 0, 'give paw'),
	('edger', 'Teddy', 5, '2020-01-03 10:00:00', 'Spanish Banks', '2020-01-01 17:00:00', 'English Bay', 0, 0, 'pat head'),
	('alice', 'Rover', 6, '2018-01-01 09:00:00', 'main street', '2018-01-01 11:00:00', 'fraser street', 1, 1, 'he is a good doggo'),
	('alice', 'Dover', 7, '2018-01-01 12:00:00', 'dunbar street', '2018-01-01 14:00:00', 'ubc', 1, 1, 'he is a good good pupper'),
	('bob', 'Spot', 8, '2018-01-01 12:00:00', 'king edward ave', '2018-01-01 17:00:00', 'dunbar', 1, 1, 'he is a good pupper'),
	('dillan', 'Fido', 9, '2018-01-02 14:00:00', 'kingsway', '2018-01-01 16:00:00', 'fraser', 1, 1, 'he is a very very good boy'),
	('carrie', 'Rex', 10, '2018-01-03 10:00:00', 'QE park', '2018-01-01 17:00:00', 'oakridge centre', 1, 1, 'he is a very good boy'),
	('edger', 'Teddy', 11, '2018-01-03 10:00:00', 'metrotown', '2018-01-01 17:00:00', 'crystal mall', 1, 1, 'he is a good boy');

INSERT INTO WalkRequest(walkerID, walkID, requestID, message, confirmed)
	VALUES ('feres', 0, 0, 'let me walk dogs pls thxs', 0),
	('george', 1, 1, 'I am very experienced with doggos', 0),
	('hilda', 2, 2, 'like, your dog is rly cute', 0),
	('igrid', 3, 3,  'I am here for dog walks', 0),
	('joe', 4, 4, 'let me walk dogs pls thxs', 0),
	('joe', 6, 5, 'walking ALL the dogs', 1),
	('joe', 7, 6, 'walking ALL the dogs', 1),
	('joe', 8, 7, 'walking ALL the dogs', 1),
	('joe', 9, 8, 'walking ALL the dogs', 1),
	('joe', 10, 9, 'walking ALL the dogs', 1),
	('joe', 11, 10, 'walking ALL the dogs', 1);



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
