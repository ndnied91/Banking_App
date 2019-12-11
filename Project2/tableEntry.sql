

create table Money_niedzwid(
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
-- CREATE TABLE, FINAL REVISE


insert into Money_niedzwid (cid, sid ,code, type , amount ,mydatetime , note )
      values(1,  1 ,'a01' , 'W' , -150, CURRENT_TIMESTAMP(), "Manually inserted" );

insert into Money_niedzwid (cid, sid ,code, type , amount ,mydatetime , note )
      values(1,  1 ,'a02' , 'D' , 150, CURRENT_TIMESTAMP(), "Manually inserted" );

insert into Money_niedzwid (cid, sid ,code, type , amount ,mydatetime , note )
      values(1,  1 ,'a03' , 'D' , 500,   CURRENT_TIMESTAMP(), "Manually inserted" );

insert into Money_niedzwid (cid, sid ,code, type , amount ,mydatetime , note )
      values(2,  2 ,'7e6' , 'W' , 1300, CURRENT_TIMESTAMP(), "Manually inserted" );
-- ADDED TO TABLE, FINAL REVISE


-- UPDATING TABLE

UPDATE Money_niedzwid SET amount = 400 WHERE mid =1;
