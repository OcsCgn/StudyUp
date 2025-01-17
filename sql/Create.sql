

DROP TABLE IF EXISTS appointments CASCADE;
DROP TABLE IF EXISTS reviews CASCADE;
DROP TABLE IF EXISTS messages CASCADE;
DROP TABLE IF EXISTS user_subjects CASCADE;
DROP TABLE IF EXISTS subjects CASCADE;
DROP TABLE IF EXISTS users CASCADE;




CREATE TYPE ROLE AS ENUM ('student', 'tutor');
CREATE TYPE EXPERTISE_LEVEL AS ENUM ('beginner', 'intermediate', 'advanced');
CREATE TYPE STATUS AS ENUM ('pending', 'confirmed', 'cancelled');

CREATE TABLE users (
    user_id SERIAL PRIMARY KEY ,
    role ROLE,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
	nom VARCHAR(200) NOT NULL,
	prenom VARCHAR(200) NOT NULL,
	sexe VARCHAR(200),
	dateNaissance DATE NOT NULL,
    phone VARCHAR(15),
	token VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE subjects (
    subject_id SERIAL PRIMARY KEY ,
    name VARCHAR(255)
);

CREATE TABLE user_subjects (
    id SERIAL PRIMARY KEY ,
    user_id INT,
    subject_id INT,
    expertise_level EXPERTISE_LEVEL NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id)ON DELETE CASCADE
);

CREATE TABLE appointments (
    appointment_id SERIAL PRIMARY KEY,
    student_id INT,
    tutor_id INT,
    subject_id INT,
    date  DATE NOT NULL,
    status STATUS NOT NULL,
    FOREIGN KEY (student_id) REFERENCES users(user_id)ON DELETE CASCADE,
    FOREIGN KEY (tutor_id) REFERENCES users(user_id)ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id)ON DELETE CASCADE
);

CREATE TABLE messages (
    message_id SERIAL PRIMARY KEY ,
    sender_id INT,
    receiver_id INT,
    content TEXT,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(user_id)ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(user_id)ON DELETE CASCADE
);

CREATE TABLE reviews (
    review_id SERIAL PRIMARY KEY,
    tutor_id INT,
    student_id INT,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tutor_id) REFERENCES users(user_id)ON DELETE CASCADE,
    FOREIGN KEY (student_id) REFERENCES users(user_id)ON DELETE CASCADE
);
