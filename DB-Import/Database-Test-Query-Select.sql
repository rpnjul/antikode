SELECT
	outlet.id,
	brand_id,
	brand.name as brand_name,
	outlet.name,
	outlet.picture,
	outlet.latitude,
	outlet.longitude,
	outlet.address,
	ROUND (
		(
			6371 * ACOS (
				COS (
					RADIANS ( outlet.latitude )) * COS (
					RADIANS (- 6.175388775718806 )) * COS (
					RADIANS ( 106.82718486295403 ) - RADIANS ( outlet.longitude )) + SIN (
					RADIANS ( outlet.latitude )) * SIN (
				RADIANS (- 6.175388775718806 )))),
		2 
	) AS distanceFromMonas,
	(SELECT count(id) FROM product WHERE outlet_id = outlet.id) as totalProduct,
	outlet.created_at,
	outlet.updated_at 
FROM
	outlet 
LEFT JOIN brand ON brand.id = outlet.brand_id
ORDER BY
	distanceFromMonas