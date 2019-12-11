create table Test_demo80(
  id int primary key not null,
  name varchar(100) not null,
);

insert into Test_demo80 values(1 'Dan');




  create table Test_niedzwid(
    mid int not null auto_increment,
    cid int(11) NOT NULL,
    sid  int(11) NOT NULL,
    code varchar(50) NOT NULL UNIQUE,
    type varchar(1) NOT NULL ,
    amount float(10) NOT NULL ,
    -- mydatetime DATE ,
    note varchar(255),

    primary key(mid),
    foreign key (cid) REFERENCES CPS3740.Customers(id),
    foreign key (sid) REFERENCES CPS3740.Sources(id)
  );




  create table Test_niedzwid(
    mid int not null auto_increment,

    cid int(11) NOT NULL,
    sid  int(11) NOT NULL,
    code varchar(50) NOT NULL UNIQUE,
    type varchar(1) NOT NULL ,
    amount float(10) NOT NULL ,
    mydatetime TimeStamp NOT NULL,
    note varchar(255),

    primary key(mid),
    foreign key (cid) REFERENCES CPS3740.Customers(id),
    foreign key (sid) REFERENCES CPS3740.Sources(id)
  );




-- THIS WORKS TO CREATE table

  -- LAB EXERCISE
--
-- insert into Test_niedzwid (code, cid, amount, note , mydatetime) values('AA' , 1 , 1,'W' , -150 , "Manually Inserter"  );

-- RUN THIS
insert into Test_niedzwid (cid, sid ,code, type , amount ,mydatetime , note )
      values(1,    1   ,'a01' , 'W' , -150, CURRENT_TIMESTAMP(), "Added manually" );

      insert into Test_niedzwid (cid, sid ,code, type , amount ,mydatetime , note )
            values(1,    1   ,'a02' , 'W' , 150, CURRENT_TIMESTAMP(), "Added manually" );


            insert into Test_niedzwid (cid, sid ,code, type , amount ,mydatetime , note )
                  values(1,    1   ,'a03' , 'W' , 0, CURRENT_TIMESTAMP(), "Added manually" );


                  insert into Test_niedzwid (cid, sid ,code, type , amount ,mydatetime , note )
                        values(1,    1   ,'a04' , 'W' , -300, CURRENT_TIMESTAMP(), "Added manually" );


-- 


Create table Students_niedzwid (
id int,
name varchar(255),
zipcode varchar(12) ,
primary key (id)
);


Create table Courses_niedzwid (
id int,
name varchar(255),
s_id int ,
primary key (id, s_id),
foreign key (s_id) REFERENCES Students_niedzwid(id));

-- THIS REFERENCES THE Students_niedzwid TABLE AS IT ASSIGNS THE foreign KEY TO S_ID

insert into Students_niedzwid (id, name, zipcode) values (1001, 'Austin', '07083'), (1002, 'Grant', '07021');

insert into Students_niedzwid values (1003, 'Mary', '07083'), (1004, 'Sam','07029');



-- 1) create the students table
-- 2) creaet the courses table
-- 3) Insert into table
-- 4) Insert second entry , when trying to add again it errors bc duplicate primary key
-- 5) Drop table Drop table Students_niedzwid;
-- 6) Deleting a certain row Delete from Students_demo where id= 1001;



-- Creating a table to auto increment
--





CREATE TABLE Test_niedzwid (
id int auto_increment primary key NOT NULL,
name varchar (100) NOT NULL
);


insert into Test_niedzwid values(1, 'Test');
insert into Test_niedzwid (name) values( 'Test3');
    -- When inserting with auto_increment you have to specify what values are begin entered
