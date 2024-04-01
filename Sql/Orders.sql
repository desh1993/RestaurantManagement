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