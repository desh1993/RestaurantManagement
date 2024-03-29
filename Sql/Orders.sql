SELECT o.id as OrderId , i.MenuId , I.Quantity,m.Name , m.Price AS Price_per_item, (m.Price * i.Quantity) as Subtotal ,s.FirstName as served_by
FROM `OrderItems` as i
INNER JOIN Orders as o
ON o.id = i.OrderId
INNER JOIN MenuItems as m
ON m.MenuItemId = i.MenuId
INNER JOIN Staff as s
ON o.StaffId = s.id;

SELECT i.OrderId, i.Quantity as Quantity , m.Name , m.Price as PricePerItem , (m.Price * i.Quantity) as TotalPrice FROM `OrderItems` as i INNER JOIN MenuItems as m ON i.MenuId = m.MenuItemId WHERE i.OrderId = 8;
