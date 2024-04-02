SELECT o.id as OrderId , i.MenuId , I.Quantity,m.Name , m.Price AS Price_per_item, (m.Price * i.Quantity) as Subtotal ,s.FirstName as served_by
FROM `OrderItems` as i
INNER JOIN Orders as o
ON o.id = i.OrderId
INNER JOIN MenuItems as m
ON m.MenuItemId = i.MenuId
INNER JOIN Staff as s
ON o.StaffId = s.id;

--SELECT orders based on order id
SELECT 
i.OrderId, 
i.Quantity as Quantity , 
m.Name , 
m.Price as PricePerItem , 
(m.Price * i.Quantity) as TotalPrice 
FROM `OrderItems` as i 
INNER JOIN MenuItems as m 
ON i.MenuId = m.MenuItemId 
WHERE i.OrderId = 8;

--SELECT orders based on table id
SELECT
i.OrderId, 
i.Quantity as Quantity , 
m.Name , 
m.Price as PricePerItem , 
(m.Price * i.Quantity) as TotalPrice 
FROM orders as o
INNER JOIN OrderItems as i 
ON o.id = i.OrderId
INNER JOIN MenuItems as m
ON m.MenuItemId = i.MenuId
WHERE o.TableId = 7;


--Search orders based on customer name or order number or table

SELECT o.id as OrderId, 
o.OrderNumber as OrderNumber , 
o.TableId as TableNo, 
o.CustomerId, 
c.username as CustomerName
FROM `Orders` as o
INNER JOIN Customers AS c
ON o.CustomerId = c.id
WHERE 
c.username LIKE '%jane%' 
OR OrderNumber LIKE '%0tn%'
OR TableId LIKE '%3%';

--Display Orders
SELECT o.id as OrderId ,  
o.TableId,
CONCAT(s.FirstName, ' ', s.LastName) as Attended_by,
subquery2.TotalAmount as TotalAmount,
c.username as CustomerName
FROM `Orders` as o
LEFT JOIN Customers AS c
ON o.CustomerId = c.id
INNER JOIN Staff as s
ON o.StaffId = s.id
INNER JOIN (
    SELECT subquery.OrderId , sum(subtotal) as TotalAmount
    FROM (
        SELECT i.OrderId , m.Name,m.Price * i.Quantity as subtotal
        FROM `OrderItems` AS i
        INNER JOIN Orders AS o
        ON o.id = i.OrderId
        INNER JOIN MenuItems AS m
        ON m.MenuItemId = i.MenuId
        ORDER BY i.OrderId
    ) AS subquery
    GROUP BY subquery.OrderId
) AS subquery2
ON o.id = subquery2.OrderId
 ;