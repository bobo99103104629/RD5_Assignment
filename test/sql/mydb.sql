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

-- 商品;
CREATE TABLE PRODUCT(
  ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(30) NOT NULL,
  State ENUM('交易中', '交易完成', '交易取消'),
  Stock INT(7) UNSIGNED NOT NULL,
  Price INT(10) UNSIGNED NOT NULL,
  Img VARCHAR(100) NOT NULL,
  Info VARCHAR(300),
  DID INT(7) UNSIGNED,
  CategoryID INT(7) UNSIGNED NOT NULL
);

-- 商品類型;
CREATE TABLE CATEGORY(
    ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(10) NOT NULL UNIQUE
);

-- 折扣;
CREATE TABLE DISCOUNT (
  ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  Type ENUM('shipping', 'seasoning', 'event'),
  PeriodFrom DATE NOT NULL,
  PeriodTo DATE NOT NULL,
  Requirement INT(7) UNSIGNED,
  Rate DOUBLE(3,3) NOT NULL,
  Info VARCHAR(100) NOT NULL,
  EventType ENUM('BOGO', 'discount')
);

-- VIEW 視界;

DROP VIEW IF EXISTS PRODUCT_VIEW;

-- 為了簡化在php中的查詢指令，建此VIEW把 PRODUCT, CATEGORY, DISCOUNT 合併成一表。;
-- PPrice: 原始價格 / PPriceDiscount: 折扣後價格，如果沒有折扣或者在期限外則為NULL;
-- PPriceF: 加入逗號的原始價格 / PPriceDiscount: 加入逗號的折扣後價格，同上。;

CREATE VIEW PRODUCT_VIEW
AS SELECT P.ID PID ,P.Name PName, P.Info PInfo, P.Img PImg, P.Stock PStock, P.State PState,
          C.Name CName, C.ID CID, D.ID DID, D.Rate DRate, D.EventType DEvent,
          (CASE WHEN ((D.PeriodTo >= NOW() AND D.PeriodFrom <= NOW()) AND D.EventType='BOGO')
                THEN 'BOGO'
                WHEN ((D.PeriodTo >= NOW() AND D.PeriodFrom <= NOW()) AND D.EventType='Discount')
                THEN 'Discount'
                ELSE NULL END) DEventType,
          P.Price PPrice,
            (CASE WHEN ((D.PeriodTo >= NOW() AND D.PeriodFrom <= NOW()) AND D.EventType='Discount')
                THEN (P.Price * D.Rate)
                ELSE NULL END) PPriceDiscount,
          FORMAT(P.Price,0) PPriceF,
          FORMAT((CASE WHEN ((D.PeriodTo >= NOW() AND D.PeriodFrom <= NOW()) AND D.EventType='Discount')
                THEN (P.Price * D.Rate)
                ELSE NULL END),0) PPriceDiscountF
           FROM PRODUCT P
           INNER JOIN CATEGORY C ON P.CategoryID = C.ID
           LEFT JOIN DISCOUNT D ON P.DID = D.ID
           WHERE P.CategoryID = C.ID
           ORDER BY PID;