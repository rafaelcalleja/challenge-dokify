CREATE VIEW UserDataView AS
 SELECT k1.*, u.user_email as email,
 rc.code as Codigo, c.code as Cupon, u.u as Fecha
 FROM wp_usermeta AS k1
 LEFT OUTER JOIN wp_usermeta AS k2
  ON (k1.user_id, k1.meta_key) = (k2.user_id, k2.meta_key) 
 LEFT JOIN wp_users u ON u.ID = k1.user_id
 LEFT JOIN app_user_code uc ON uc.wp_users_id = k1.user_id
 LEFT JOIN app_register_code rc ON rc.id = uc.register_code_id 
 LEFT JOIN app_coupon c ON c.id = uc.coupon_id;

CREATE VIEW CompleteUserData AS
SELECT user_id, 
  email AS Email,
  Fecha,
  Codigo,
  Cupon,
  MAX(CASE meta_key WHEN 'first_name' THEN meta_value END) AS Nombre,
  MAX(CASE meta_key WHEN 'last_name' THEN meta_value END) AS Apellidos,
  MAX(CASE meta_key WHEN 'display_name' THEN meta_value END) AS Alias,
  MAX(CASE meta_key WHEN 'edad' THEN meta_value END) AS Edad,
  MAX(CASE meta_key WHEN 'sexo' THEN meta_value END) AS Sexo,
  MAX(CASE meta_key WHEN 'dni' THEN meta_value END) AS DNI,
  MAX(CASE meta_key WHEN 'provincia' THEN meta_value END) AS Provincia,
  MAX(CASE meta_key WHEN 'ciudad' THEN meta_value END) AS Ciudad,
  MAX(CASE meta_key WHEN 'direccion' THEN meta_value END) AS Direccion,
  MAX(CASE meta_key WHEN 'profesion' THEN meta_value END) AS Profesion,
  MAX(CASE meta_key WHEN 'cargo' THEN meta_value END) AS Cargo,
  MAX(CASE meta_key WHEN 'anos_experiencia' THEN meta_value END) AS AnosExperiencia,
  MAX(CASE meta_key WHEN 'ambito' THEN meta_value END) AS Ambito,
  MAX(CASE meta_key WHEN 'establecimiento' THEN meta_value END) AS Establecimiento,
  MAX(CASE meta_key WHEN 'numero_establecimientos' THEN meta_value END) AS NumeroEstablecimientos,
  MAX(CASE meta_key WHEN 'tipo_establecimiento' THEN meta_value END) AS TipoEstablecimiento,
  MAX(CASE meta_key WHEN 'desarrollo_profesional' THEN meta_value END) AS DesarrolloProfesional
FROM UserDataView
GROUP BY user_id;
