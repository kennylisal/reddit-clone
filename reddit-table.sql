-- Subreddits table: Stores information about each subreddit community
CREATE TABLE Subreddits (
    subreddit_id SERIAL PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    subreddit_type ENUM('public', 'restricted', 'private') NOT NULL DEFAULT 'public'
);

-- Moderators table: Tracks subreddit moderators
CREATE TABLE Moderators (
    user_id INTEGER NOT NULL REFERENCES Users(user_id),
    subreddit_id INTEGER NOT NULL REFERENCES Subreddits(subreddit_id),
    PRIMARY KEY (user_id, subreddit_id)
);

-- Approved_Users table: Tracks approved users for restricted/private subreddits
CREATE TABLE Approved_Users (
    user_id INTEGER NOT NULL REFERENCES Users(user_id),
    subreddit_id INTEGER NOT NULL REFERENCES Subreddits(subreddit_id),
    PRIMARY KEY (user_id, subreddit_id)
);

-- Subscriptions table: Tracks user subscriptions to subreddits
CREATE TABLE Subscriptions (
    user_id INTEGER NOT NULL REFERENCES Users(user_id),
    subreddit_id INTEGER NOT NULL REFERENCES Subreddits(subreddit_id),
    PRIMARY KEY (user_id, subreddit_id)
);

CREATE TABLE Posts (
    post_id SERIAL PRIMARY KEY,
    subreddit_id INTEGER NOT NULL REFERENCES Subreddits(subreddit_id),
    user_id INTEGER NOT NULL REFERENCES Users(user_id),
    title VARCHAR(255) NOT NULL,
    content_type ENUM('text', 'link', 'image') NOT NULL,
    content TEXT,
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    score INTEGER NOT NULL DEFAULT 0,
    num_comments INTEGER NOT NULL DEFAULT 0,
    flair_text VARCHAR(100),
    stickied BOOLEAN NOT NULL DEFAULT FALSE,
    locked BOOLEAN NOT NULL DEFAULT FALSE,
    deleted BOOLEAN NOT NULL DEFAULT FALSE
);

-- Users table: Stores redditor (user) details
CREATE TABLE Users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(255),
    join_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    post_karma INTEGER NOT NULL DEFAULT 0,
    comment_karma INTEGER NOT NULL DEFAULT 0
);

-- Posts table: Stores thread starter posts


-- Comments table: Stores comments with hierarchical structure
CREATE TABLE Comments (
    comment_id SERIAL PRIMARY KEY,
    post_id INTEGER NOT NULL REFERENCES Posts(post_id),
    parent_comment_id INTEGER REFERENCES Comments(comment_id),
    user_id INTEGER NOT NULL REFERENCES Users(user_id),
    content TEXT NOT NULL,
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    score INTEGER NOT NULL DEFAULT 0,
    deleted BOOLEAN NOT NULL DEFAULT FALSE
);

-- Post_Votes table: Tracks votes on posts
CREATE TABLE Post_Votes (
    post_id INTEGER NOT NULL REFERENCES Posts(post_id),
    user_id INTEGER NOT NULL REFERENCES Users(user_id),
    vote_type ENUM('up', 'down') NOT NULL,
    PRIMARY KEY (post_id, user_id)
);

-- Comment_Votes table: Tracks votes on comments
CREATE TABLE Comment_Votes (
    comment_id INTEGER NOT NULL REFERENCES Comments(comment_id),
    user_id INTEGER NOT NULL REFERENCES Users(user_id),
    vote_type ENUM('up', 'down') NOT NULL,
    PRIMARY KEY (comment_id, user_id)
);


-- Followers table: Tracks user-to-user following
CREATE TABLE Followers (
    follower_id INTEGER NOT NULL REFERENCES Users(user_id),
    followee_id INTEGER NOT NULL REFERENCES Users(user_id),
    PRIMARY KEY (follower_id, followee_id)
);


-- Indexes for performance optimization
CREATE INDEX idx_posts_subreddit_id ON Posts(subreddit_id);
CREATE INDEX idx_posts_user_id ON Posts(user_id);
CREATE INDEX idx_comments_post_id ON Comments(post_id);
CREATE INDEX idx_comments_parent_comment_id ON Comments(parent_comment_id);
