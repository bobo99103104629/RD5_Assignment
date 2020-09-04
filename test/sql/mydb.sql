CREATE DATABASE bobo;
-- 會員資料;
CREATE TABLE MEMBER(
  ID VARCHAR(20) PRIMARY KEY,
  Password VARCHAR(128) NOT NULL,
  Name VARCHAR(12) NOT NULL,
  Money VARCHAR(20) NOT NULL,
  Email VARCHAR(30) NOT NULL,
  Phone VARCHAR(10) NOT NULL,
  RegDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  Birth DATE,
  Gender ENUM('M', 'F', 'N'),
  Address VARCHAR(100),
  Position ENUM('S', 'A', 'C') NOT NULL
);

-- 提款;
CREATE TABLE PRODUCT(
  pid INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ID VARCHAR(20),
  Name VARCHAR(30) DEFAULT NULL,
  Price INT(10) UNSIGNED DEFAULT NULL,
  total INT(10) UNSIGNED DEFAULT NULL,
  Img VARCHAR(100) DEFAULT NULL,
  Info VARCHAR(300),
  ptime VARCHAR(100) DEFAULT NULL,
  CategoryID INT(7) UNSIGNED DEFAULT NULL
  REFERENCES MEMBER(ID)
);



-- 類型;
CREATE TABLE CATEGORY(
  ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(10) NOT NULL UNIQUE
);


-- VIEW 視界;

DROP VIEW IF EXISTS PRODUCT_VIEW;

-- 為了簡化在php中的查詢指令，建此VIEW把 PRODUCT, CATEGORY, DISCOUNT 合併成一表。;
-- PPrice: 原始價格 / PPriceDiscount: 折扣後價格，如果沒有折扣或者在期限外則為NULL;
-- PPriceF: 加入逗號的原始價格 / PPriceDiscount: 加入逗號的折扣後價格，同上。;

CREATE VIEW PRODUCT_VIEW
AS SELECT P.pid PP ,P.ID PID ,P.Name PName, P.Info PInfo, P.Img PImg,
          C.Name CName, C.ID CID,P.Price PPriceF,P.total Ptotal,P.ptime Ptime
           FROM PRODUCT P
           INNER JOIN CATEGORY C ON P.CategoryID = C.ID
           WHERE P.CategoryID = C.ID
           ORDER BY PID;

        