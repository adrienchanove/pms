-- SQLite

-- Pragma
PRAGMA foreign_keys = ON;


-- Drop tables
DROP TABLE IF EXISTS user;



-- Create tables
CREATE TABLE IF NOT EXISTS user ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	username         VARCHAR( 250 ),
	password       VARCHAR( 250 ),
	is_admin       BOOLEAN
);




-- Foreign keys
-- ALTER TABLE UserGroupe ADD FOREIGN KEY (user_id) REFERENCES User(id);
-- ALTER TABLE UserGroupe ADD FOREIGN KEY (group_id) REFERENCES Groupe(id);
-- ALTER TABLE privateMessage ADD FOREIGN KEY (sender_id) REFERENCES User(id);
-- ALTER TABLE privateMessage ADD FOREIGN KEY (receiver_id) REFERENCES User(id);

-- Insert data
-- 		User
INSERT INTO user (username, password, is_admin) VALUES ('admin', 'chamallow', 1);
INSERT INTO user (username, password, is_admin) VALUES ('user', 'kinder', 0);

