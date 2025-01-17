-- Insert users
INSERT INTO users (role, username, email, password, nom, prenom, sexe, dateNaissance, phone, token)
VALUES
('student', 'john_doe', 'john.doe@example.com', 'hashed_password1', 'Doe', 'John', 'M', '2001-04-15', '1234567890', 'token1234'),
('tutor', 'jane_smith', 'jane.smith@example.com', 'hashed_password2', 'Smith', 'Jane', 'F', '1995-08-20', '0987654321', 'token5678'),
('student', 'alice_brown', 'alice.brown@example.com', 'hashed_password3', 'Brown', 'Alice', 'F', '2003-01-10', '1231231234', 'token9101');

-- Insert subjects
INSERT INTO subjects (name)
VALUES
('Mathematics'),
('Physics'),
('Computer Science'),
('Chemistry');

-- Insert user_subjects (link between users and subjects)
INSERT INTO user_subjects (user_id, subject_id, expertise_level)
VALUES
(2, 1, 'advanced'), -- Tutor Jane teaches Mathematics
(2, 3, 'intermediate'), -- Tutor Jane teaches Computer Science
(3, 4, 'beginner'); -- Alice has beginner level in Chemistry

-- Insert appointments
INSERT INTO appointments (student_id, tutor_id, subject_id, date, status)
VALUES
(1, 2, 1, '2025-01-20', 'confirmed'), -- John has an appointment with Jane for Mathematics
(3, 2, 3, '2025-01-22', 'pending'); -- Alice requested an appointment with Jane for Computer Science

-- Insert messages
INSERT INTO messages (sender_id, receiver_id, content)
VALUES
(1, 2, 'Hello Jane, I need help with Math!'), -- John sends a message to Jane
(2, 1, 'Sure, let’s schedule a session.'),
(3, 2, 'Can you help me with Computer Science?');

-- Insert reviews
INSERT INTO reviews (tutor_id, student_id, rating, comment)
VALUES
(2, 1, 5, 'Jane is an excellent tutor!'),
(2, 3, 4, 'Helpful but needs more practical examples.');
