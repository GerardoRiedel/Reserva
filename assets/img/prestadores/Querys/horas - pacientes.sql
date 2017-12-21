SELECT * FROM cetepcl_agenda.horas where usuario != 282 and urlEstadoEnvioColmena!=1 and hora>'2017-10-10' and isapre=4 and ciudad !=73;

SELECT * FROM cetepcl_agenda.horas where paciente=(select id from cetepcl_agenda.pacientes where rut=16810786) and id!=181758;
SELECT * FROM cetepcl_agenda.pacientes where id=146543 OR rut=7385992;
SELECT * FROM cetepcl_agenda.horas_eliminadas where isapre=4 and paciente=146286 order by id desc;

SELECT * FROM cetepcl_agenda.horas where hora ='2017-10-14 10:30:00' and prestador=103;

SELECT * FROM cetepcl_agenda.horas where paciente=145414;

SELECT * FROM cetepcl_agenda.horas where urlEstadoEnvioColmena=1 and hora>='2017-07-27' and hora<'2017-08-10' and isapre=4 and asiste='si';

SELECT * FROM cetepcl_agenda.horas where id=215288;

SELECT * FROM cetepcl_agenda.horas where isapre=4 and hora>='2017-09-01' and hora <'2017-10-01';

SELECT * FROM cetepcl_agenda.horas where hora>='2017-10-13' and hora <'2017-10-15' and asiste!='atrasado' and asiste!='si';

