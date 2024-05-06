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




select * from recibosdecaja where fecha between '2024-04-24 00:00:00' and '2024-04-24 23:59:59' and idParqueadero = 2;

select valor from recibosdecaja where fecha between '2024-04-24 00:00:00' and '2024-04-24 23:59:59' and idParqueadero = 2;

select * from recibosdecaja 
where fecha between '2024-04-24 00:00:00' and '2024-04-24 23:59:59' 
and idParqueadero = 2
and idFormaDePago = 1

//consulta sobre la tabla de parking
select sum(r.valor) from parking p
inner join recibosdecaja r on (r.id = p.idreciboCaja)
where 1=1 
and estado > 0 
and p.idParqueadero = '2' 
and horaSalida >= '2024-04-24 00:00:00' 
and horaSalida <= '2024-04-24 23:59:59'

//consulta sobre recibos de caja
select count(idParking),idparking from recibosdecaja 
where fecha between '2024-04-25 00:00:00' and '2024-04-25 23:59:59' 
and idParqueadero = 2
group by idParking
having count(idParking)>1

select count(idParking),idparking from recibosdecaja 
group by idParking
having count(idParking)>1;
