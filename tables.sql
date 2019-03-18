CREATE TABLE User
(
    userID INT(12),
    username VARCHAR(64),
    accountBalance DOUBLE,
    PRIMARY KEY(userID)
);

CREATE TABLE Friend
(
    User1 INT(12),
    User2 INT(12),
    date DATE,
    FOREIGN KEY(User1) REFERENCES User(userID),
    FOREIGN KEY(User2) REFERENCES User(userID),
    PRIMARY KEY(User1, User2)
);

CREATE TABLE Vgroup
(
    groupID INT(12),
    groupName VARCHAR(64),
    PRIMARY KEY(groupID)
);

CREATE TABLE Member_in_group
(
    userID INT(12),
    groupID INT(12),
    role ENUM('group_creater', 'administrator', 'member'),
    PRIMARY KEY(userID, groupID),
    FOREIGN KEY(userID) REFERENCES User(userID),
    FOREIGN KEY(groupID) REFERENCES Vgroup(groupID)
);

CREATE TABLE Merchant
(
    merchantID INT(12),
    merchantName VARCHAR(64),
    PRIMARY KEY(merchantID)
);

CREATE TABLE Mobilespot
(
    merchantID INT(12),
    spotID INT(12),
    location TEXT,
    PRIMARY KEY(merchantID, spotID),
    FOREIGN KEY(merchantID) REFERENCES Merchant(merchantID)
);

CREATE TABLE Transaction
(
    transactionID INT(12),
    date DATE,
    amount DOUBLE,
    make_userID INT(12),
    PRIMARY KEY(transactionID),
    FOREIGN KEY (make_userID) REFERENCES User(userID)
);

CREATE TABLE P2Ptransfer
(
    transactionID INT(12),
    transferTo_userID INT(12),
    PRIMARY KEY(transactionID),
    FOREIGN KEY(transactionID) REFERENCES Transaction(transactionID),
    FOREIGN KEY(transferTo_userID) REFERENCES User(userID)
);

CREATE TABLE Payment
(
    transactionID INT(12),
    merchantID INT(12),
    spotID INT(12),
    PRIMARY KEY(transactionID),
    FOREIGN KEY(transactionID) REFERENCES Transaction(transactionID),
    FOREIGN KEY(merchantID, spotID) REFERENCES Mobilespot(merchantID, spotID)
);
