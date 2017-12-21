SELECT p.nombres 'Perito Nombre', p.apellidoPaterno 'Perito Apellido Materno', p.apellidoMaterno 'Perito Apellido Materno', a.rut 'Rut Paciente',cetepcl_agenda.f_digito(a.rut) AS Digito,c.ciudad Ciudad, h.asiste Asistencia,h.hora Hora
FROM cetepcl_agenda.horas h 
join cetepcl_agenda.prestadores p on p.id=h.prestador 
join cetepcl_agenda.pacientes a on a.id=h.paciente 
join cetepcl_agenda.ciudades c on c.id=h.ciudad 
where h.hora>'2017-11-01' and h.hora<'2017-12-01' and h.usuario=511;