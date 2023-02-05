create table salle
(
    id    int auto_increment
        primary key,
    label varchar(255) not null,
    image text         not null
);

create table film
(
    id      int auto_increment
        primary key,
    idSalon int                    not null,
    label   varchar(255)           not null,
    image   text                   not null,
    date    date default curdate() not null,
    constraint film_ibfk_1
        foreign key (idSalon) references salle (id)
);

create index idSalon
    on film (idSalon);

create table user
(
    id         int auto_increment
        primary key,
    email      varchar(255)                          not null,
    firstName  varchar(255)                          not null,
    lastName   varchar(255)                          not null,
    image      text                                  null,
    created_at timestamp default current_timestamp() not null
);

create table reservation
(
    id      int auto_increment
        primary key,
    idUser  int not null,
    idFilm  int not null,
    numSeat int not null,
    constraint reservation_unique_place
        unique (idFilm, numSeat),
    constraint reservation_ibfk_1
        foreign key (idUser) references user (id),
    constraint reservation_ibfk_2
        foreign key (idFilm) references film (id),
    check (`numSeat` between 1 and 50)
);

create index idUser
    on reservation (idUser);

