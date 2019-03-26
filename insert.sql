
INSERT INTO DogOwner(Username, Password, userImage, PhoneNum)
	VALUES('alice', 'password', 'alice.jpg', '111-111-1111'),
	VALUES('bob', 'password', 'bob.jpg', '222-222-2222'),
	VALUES('carrie', 'password', 'carrie.jpg', '333-333-3333'),
	VALUES('dillan', 'password', 'dillan.jpg', '444-444-4444'),
	VALUES('edger', 'password', 'edger.jpg', '555-555-5555');

INSERT INTO DogWalker(Username, Password, userImage, PhoneNum, personalBio,  WalksCompleted)
	VALUES('feres', 'password', 'feres.jpg', '011-111-1111', 'Just here to walk some dogs',0),
	VALUES('george', 'password', 'george.jpg', '022-222-2222', 'a dog walker', 0),
	VALUES('hilda', 'password', 'hilda.jpg', '033-333-3333', 'give me dogs', 1),
	VALUES('igrid', 'password', 'igrid.jpg', '044-444-4444', 'i like walks', 1),
	VALUES('joe', 'password', 'joe.jpg', '055-555-5555', 'give me walks', 0);

INSERT INTO Dog(Name, Age, Breed, Gender, dogImage, Owner)
	VALUES('Rover', 4, 'dalmation', 'M', 'rover.jpg', 'alice'),
	VALUES('Spot', 4, 'husky', 'F', 'spot.jpg', 'bob'),
	VALUES('Rex', 4, 'great-dane', 'M', 'rex.jpg',  'carrie'),
	VALUES('Fido', 4, 'yorkshire-terrior', 'F', 'fido.jpg', 'dillan'),
	VALUES('Rover', 4, 'border-collie', 'M', 'rover.jpg', 'edger');

INSERT INTO DogType(age, breed, size)
	VALUES(1, 'golden retriever', 'S'),
	VALUES(2, 'golden retriever', 'M'),
	VALUES(3, 'golden retriever', 'L'),
	VALUES(4, 'golden retriever', 'L'),
	VALUES(5, 'golden retriever', 'L'),
	VALUES(6, 'golden retriever', 'L'),
	VALUES(7, 'golden retriever', 'L'),
	VALUES(8, 'golden retriever', 'L'),
	VALUES(9, 'golden retriever', 'L'),
	VALUES(10, 'golden retriever', 'L'),
	VALUES(11, 'golden retriever', 'L'),
	VALUES(12, 'golden retriever', 'L'),
	VALUES(13, 'golden retriever', 'L'),
	VALUES(14, 'golden retriever', 'L'),
	VALUES(15, 'golden retriever', 'L'),
	VALUES(16, 'golden retriever', 'L'),
	VALUES(17, 'golden retriever', 'L'),
	VALUES(1, 'corgi', 'S'),
	VALUES(2, 'corgi', 'M'),
	VALUES(3, 'corgi', 'M'),
	VALUES(4, 'corgi', 'M'),
	VALUES(5, 'corgi', 'M'),
	VALUES(6, 'corgi', 'M'),
	VALUES(7, 'corgi', 'M'),
	VALUES(8, 'corgi', 'M'),
	VALUES(9, 'corgi', 'M'),
	VALUES(10, 'corgi', 'M'),
	VALUES(11, 'corgi', 'M'),
	VALUES(12, 'corgi', 'M'),
	VALUES(13, 'corgi', 'M'),
	VALUES(14, 'corgi', 'M'),
	VALUES(15, 'corgi', 'M'),
	VALUES(16, 'corgi', 'M'),
	VALUES(17, 'corgi', 'M'),
	VALUES(1, 'pomerainian', 'S'),
	VALUES(2, 'pomerainian', 'S'),
	VALUES(3, 'pomerainian', 'S'),
	VALUES(4, 'pomerainian', 'S'),
	VALUES(5, 'pomerainian', 'S'),
	VALUES(6, 'pomerainian', 'S'),
	VALUES(7, 'pomerainian', 'S'),
	VALUES(8, 'pomerainian', 'S'),
	VALUES(9, 'pomerainian', 'S'),
	VALUES(10, 'pomerainian', 'S'),
	VALUES(11, 'pomerainian', 'S'),
	VALUES(12, 'pomerainian', 'S'),
	VALUES(13, 'pomerainian', 'S'),
	VALUES(14, 'pomerainian', 'S'),
	VALUES(15, 'pomerainian', 'S'),
	VALUES(16, 'pomerainian', 'S'),
	VALUES(17, 'pomerainian', 'S'),
	VALUES(1, 'pit bull', 'S'),
	VALUES(2, 'pit bull', 'M'),
	VALUES(3, 'pit bull', 'L'),
	VALUES(4, 'pit bull', 'L'),
	VALUES(5, 'pit bull', 'L'),
	VALUES(6, 'pit bull', 'L'),
	VALUES(7, 'pit bull', 'L'),
	VALUES(8, 'pit bull', 'L'),
	VALUES(9, 'pit bull', 'L'),
	VALUES(10, 'pit bull', 'L'),
	VALUES(11, 'pit bull', 'L'),
	VALUES(12, 'pit bull', 'L'),
	VALUES(13, 'pit bull', 'L'),
	VALUES(14, 'pit bull', 'L'),
	VALUES(15, 'pit bull', 'L'),
	VALUES(16, 'pit bull', 'L'),
	VALUES(17, 'pit bull', 'L'),
	VALUES(1, 'husky', 'M'),
	VALUES(2, 'husky', 'L'),
	VALUES(3, 'husky', 'L'),
	VALUES(4, 'husky', 'L'),
	VALUES(5, 'husky', 'L'),
	VALUES(6, 'husky', 'L'),
	VALUES(7, 'husky', 'L'),
	VALUES(8, 'husky', 'L'),
	VALUES(9, 'husky', 'L'),
	VALUES(10, 'husky', 'L'),
	VALUES(11, 'husky', 'L'),
	VALUES(12, 'husky', 'L'),
	VALUES(13, 'husky', 'L'),
	VALUES(14, 'husky', 'L'),
	VALUES(15, 'husky', 'L'),
	VALUES(16, 'husky', 'L'),
	VALUES(17, 'husky', 'L');

INSERT INTO WalkPost(Owner, Dog, referenceID, starttime, startlocation, endtime, endlocation, booked, completed, specialRequests)
	VALUES('alice', 'Rover', 0, '2020-01-01 00:08:00', '49:-123.2', '2020-01-01 00:08:00', '49:-123', '49:-123.1', 'F', 'F', 'throw ball'),
	VALUES('alice', 'Rover', 1, '2020-01-01 00:08:00', '49:-123.1', '2020-01-01 00:08:00', '49:-123', '49:-123.1', 'F', 'F', 'throw ball'),
	VALUES('bob', 'Spot', 2, '2020-01-01 00:08:00', '49.1:-123', '2020-01-01 00:08:00', '49:-123', '49:-123.1', 'F', 'F', 'throw frisbee'),
	VALUES('dillan', 'Fido', 3, '2020-01-01 00:08:00', '49.2:-123', '2020-01-01 00:08:00', '49.1:-123.1', '49:-122.5', 'F', 'F', 'run'),
	VALUES('carrie', 'Rex', 4, '2020-01-01 00:08:00', '49:-123', '2020-01-01 00:08:00', '49.1:-123', '49:-123.1', 'F', 'F', 'rub belly');

INSERT INTO WalkRequest(walkerID, walkID, requestID, message, confirmed)
	VALUES('feres', 0, 3, 'let me walk dogs pls thxs', 'F'),
	VALUES('george', 1, 4, 'I am very experienced with doggos', 'F'),
	VALUES('hilda', 2, 1, 'like, your dog is rly cute', 'F'),
	VALUES('igrid', 3, 8,  'I am here for dog walks', 'F'),
	VALUES('joe', 4, 9, 'let me walk dogs pls thxs', 'F');

INSERT INTO Review(writtenBy, writtenFor, reviewID, rating, date, comment)
	VALUES('alice', 'feres', 0, 4, '2020-01-01 00:08:00', 'pretty chill dude tbh'),
	VALUES('alice', 'george', 1, 1, '2020-01-01 00:08:00',  'Not very experienced'),
	VALUES('bob', 'hilda', 2, 5, '2020-01-01 00:08:00', 'What a nice lady'),
	VALUES('dillan', 'igrid', 3, 1, '2020-01-01 00:08:00', 'Could not keep up with dog'),
	VALUES('carrie', 'joe', 4, 5, '2020-01-01 00:08:00', 'Brought treats for dog. Wow');

INSERT INTO ownerNameNum(Name, Num)
	VALUES('Alice Margeret', '111-111-1111'),
	VALUES('Robert Picton', '222-222-2222'),
	VALUES('Carrie Smith', '333-333-3333'),
	VALUES('Dillan Thomas', '444-444-4444'),
	VALUES('Edgar Wellington', '555-555-5555');

INSERT INTO walkerNameNum(Name, Num)
	VALUES('Feres Salem', '011-111-1111'),
	VALUES('George Renford', '022-222-2222'),
	VALUES('Hilda Ostereich', '033-333-3333'),
	VALUES('Igrid Smolson', '044-444-4444'),
	VALUES('Joseph Aramathia', '055-555-5555');

INSERT INTO DogMeetup(EventID, time, location, postedBy)
	VALUES(0, '2020-01-01 00:08:00', '49.2:-123.2', 'edger'),
	VALUES(1, '2020-01-01 00:08:00', '49:-123.1', 'edger'),
	VALUES(2, '2020-01-01 00:08:00', '49:-123.2', 'edger'),
	VALUES(3, '2020-01-01 00:08:00', '49.1:-123.1', 'edger'),
	VALUES(4, '2020-01-01 00:08:00', '49.1:-123.1', 'edger');
