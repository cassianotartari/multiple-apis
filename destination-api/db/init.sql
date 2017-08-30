CREATE TABLE courses (
    id      BIGSERIAL PRIMARY KEY,
    title    VARCHAR NOT NULL,
    grade    INTEGER NOT NULL,
    srcid    VARCHAR NOT NULL
);

