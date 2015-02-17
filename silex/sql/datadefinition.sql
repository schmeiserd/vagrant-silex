USE silex;

-- CREATE YOUR TABLES HERE
CREATE TABLE blog_post (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  text TEXT,
  created_at DATE
);

INSERT INTO blog_post
  (title, text, created_at)
VALUES
  ('New Title', 'This is the content', CURRENT_DATE);

SELECT *
FROM blog_post;

SELECT *
FROM blog_post
WHERE id = 1;

