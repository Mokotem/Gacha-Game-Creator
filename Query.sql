

CREATE VIEW AvailableItems AS
    SELECT idGacha, idItem, idEffect
    FROM Item I CROSS JOIN Effect E
    WHERE NOT EXISTS
        (SELECT *
         FROM HaveItem H
         WHERE H.idItem = I.idItem
         AND H.idEffect = E.idEffect);
