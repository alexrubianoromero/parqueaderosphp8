truncate perfiles;

truncate parking;
truncate recibosdecaja;

update parking set estado = 0 ; 


parking

SELECT * FROM parking WHERE idParqueadero = 2 and horaIngreso between  '2024-04-11:00:00:00' and '2024-04-11:23:59:59' 

--delete from parking WHERE idParqueadero = 2 and horaIngreso between  '2024-04-11:00:00:00' and '2024-04-11:23:59:59' 

recibos de caja

select * from recibosdecaja where idParqueadero = 2 and fecha between  '2024-04-11:00:00:00' and '2024-04-11:23:59:59'

--delete from recibosdecaja where idParqueadero = 2 and fecha between  '2024-04-11:00:00:00' and '2024-04-11:23:59:59'