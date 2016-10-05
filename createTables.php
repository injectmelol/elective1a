		<?php  
include_once 'dbconfig.php';

$createTables = array();

$createTables[0] = "CREATE TABLE IF NOT EXISTS Users(
	userId int PRIMARY KEY  auto_increment,
	userName varchar(10) not null,
	password text not null);";

$createTables[1]  = "CREATE TABLE IF NOT EXISTS Groups(
	groupId int PRIMARY KEY auto_increment,
	groupName varchar(15) not null);";

$createTables[2]  = "CREATE TABLE IF NOT EXISTS UserGroups(
	userId int,
	foreign key (userId) references Users(userId),
	groupId int,
	foreign key (groupId) references Groups(groupId),
	primary key(userId,groupId));";

$createTables[3]  = "CREATE TABLE IF NOT EXISTS Person(
	PersonId int PRIMARY KEY auto_increment,
	userId int,
	foreign key(userId) references Users(userId),
	TitleofCourtesy varchar(5) not null,
	firstName varchar(20) not null,
	middleInitial varchar(3),
	lastName varchar(20) not null);";

$createTables[4]  = "CREATE TABLE IF NOT EXISTS FacultyMember(
	FacultyId int PRIMARY KEY auto_increment,
	PersonId int,
	foreign key(PersonId) references Person(PersonId),
	SSN varchar(20) not null,
	HomeStreetAddress varchar(80) not null,
	HomeCity varchar(30) not null,
	HomeZip varchar(10) not null,
	HomePhone varchar(15) not null,
	DayTimePhone varchar(15) not null,
	AdjunctHireDate datetime not null,
	FullTimeHireDate datetime not null,
	RetireDate datetime not null,
	emailAddress varchar(30) not null,
	DOB datetime not null);";

$createTables[5] = "CREATE TABLE IF NOT EXISTS PublicationType(
	PublicationTypeID int primary key auto_increment,
	PublicationTypeDesc nVarchar(50) NOT NULL);";

$createTables[6] = "CREATE TABLE IF NOT EXISTS Publication(
	PublicationId int(4) PRIMARY KEY auto_increment,
	PublicationTitle int(3) NOT NULL,
	ArticleOrChapterTitle int(2) NOT NULL,
	VolAndPageCite varchar(50) NOT NULL,
	PublisherName varchar(125) NOT NULL,	
	PublicationLocation varchar(100) NOT NULL,
	PublicationHyperlink text NOT NULL,
	PublicationStatus varchar(30) NOT NULL,
	CitationDate varchar(20) NOT NULL ,
	PatentApplicationDate datetime NOT NULL,
	PatentNumber varchar(50) NOT NULL,
	PublicationTypeID int,
	foreign key (PublicationTypeID) references PublicationType(PublicationTypeID));";

$createTables[7] = "CREATE TABLE IF NOT EXISTS Department(
	DeptID int primary key auto_increment,
	DeptName nVarchar(50) NOT NULL)";

$createTables[8] = "CREATE TABLE  IF NOT EXISTS Jobs(
	JobTypeID smallint primary key auto_increment,
	JobType nvarchar(100) NOT NULL);";

$createTables[9]  = "CREATE TABLE IF NOT EXISTS WorkHistory(
	WorkHistoryID int primary key auto_increment,
	PersonId int,
	foreign key (PersonId) references Person(PersonId),
	DeptID int,
	foreign key (DeptID) references Department(DeptID),
	JobTitle nVarchar(100) NOT NULL,
	JobBeginDate datetime NOT NULL,
	JobEndDate datetime NOT NULL,
	JobResponsibilities nVarchar(250) NOT NULL,
	JobTypeID smallint,
	foreign key(JobTypeID) references Jobs(JobTypeID));";

$createTables[10] = "CREATE TABLE IF NOT EXISTS Degrees(
	DegreeID int primary key,
	PersonId int,
	foreign key (PersonId) references Person(PersonId),
	DegreeMajor nVarchar(200) not null,
	DegreeMinor nvarchar(40) NOT NULL,
	DegreeTitle nvarchar(20) NOT NULL,
	DeptID int,
	foreign key(DeptID) references Department(DeptId),
	DegreeYear dateTime NOT NULL);";

$createTables[11] = "CREATE TABLE IF NOT EXISTS Grants(
	GrantID int primary key auto_increment,
	GrantTitle varchar(150) NOT NULL,
	GrantDescription varchar(250) NOT NULL,
	AwardSponsor Varchar(150) NOT NULL,
	GrantOrAward bit);";

$createTables[12] = "CREATE TABLE IF NOT EXISTS Courses(
	CourseID int primary key auto_increment,
	DeptID int,
	foreign key(DeptID) references Department(DeptID),
	CatalogNumber nVarchar(15) NOT NULL,
	CourseName nVarchar(100) NOT NULL,
	courseLevel nVarchar(20) NOT NULL,
	CourseCredits Smallint NOT NULL,
	CourseSubject nVarchar(5) NOT NULL)";


$createTables[13] = "CREATE TABLE IF NOT EXISTS PubAuthorType(
	PubAuthorTypeID smallint primary key auto_increment,
	PubAuthorDesc nvarchar(50) NOT NULL);";


$createTables[14] = "CREATE TABLE IF NOT EXISTS RelationAuthor(
	PubAuthorTypeID smallint,
	foreign key(PubAuthorTypeID) references PubAuthorType(PubAuthorTypeID),
	PublicationID int(4),
	foreign key(PublicationID) references Publication(PublicationID),
	PersonID int,
	foreign key(PersonID) references Person(PersonID),
	primary key(PubAuthorTypeID,PublicationID,PersonID));";

$createTables[15] = "CREATE TABLE IF NOT EXISTS CoursesTaught(
	CourseID int,
	foreign key(CourseID) references Courses(CourseID),
	PersonID int,
	foreign key(PersonID) references Person(PersonID),
	FirstDateTaught datetime NOT NULL,
	primary key(CourseID,PersonID));";

$createTables[16] = "CREATE TABLE IF NOT EXISTS GrantRecipients(
	RecipientID smallint primary key auto_increment,
	DeptID int,
	foreign key(DeptID) references Department(DeptID),
	GrantID int,
	foreign key(GrantID) references Grants(GrantID),	
	PersonID int,
	foreign key(PersonID) references Person(PersonID),
	GrantBeginDate datetime NOT NULL,
	GrantEndDate datetime NOT NULL,
	GrantAmount int NOT NULL,
	GrantPurpose nvarchar(250) NOT NULL);";

	foreach ($createTables as $value)
	{
		$sql_query = $value;
		$statement = $db->prepare($sql_query);

		$statement->execute();
	}
?>