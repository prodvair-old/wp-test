<?php

/**
 * Render Email template
 *
 * @param array $data
 * @return void
 */
function renderEmailTemplate($data)
{
	$html = <<<HTMLCONTENT
    <!doctype html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
            html,
            body {
				font-family: Verdana, sans-serif;
				font-size: 14px;
				background: #efefef;
				color: #003351;
			}
			.wrapper {
				max-width: 720px;
				padding: 15px;
				background: #efefef;
			}
			.title {
				font-size: 1.5rem;
				color: #5e7188;
			}
			.table {
				width: 100%;
				margin: 0 auto;
				overflow: auto;
				background: #fff;
				box-shadow: 0 3px 15px -5px rgba(0, 0, 0, .1);
				border-collapse: collapse;
			}
			.column {
				border: 1px solid #efefef;
				padding: 10px;
				overflow: hidden;
				max-height: 200px;
			}
			.column img {
                width: 100%;
                max-width: 150px;
                max-height: 150px;
			}
			.column--strong {
				font-weight: 700;
				color: #003351;
			}
		</style>
    </head>
	<body>
		<div class="wrapper">
			<h2 class="title">{$data['title']}</h2>
			<div class="content">{$data['content']}</div>
		</div>
    </body>
    </html>
HTMLCONTENT;

	return $html;
}

/**
 * Render html table for array data
 */
function renderHTMLTableForArray($array, $title = "Данные")
{
	$htmlTable = "<table class='table'><thead><tr><td class='column column--strong' colspan='2'>$title</td></tr></thead><tbody>";

	foreach ($array as $key => $value) {
		$htmlTable .= "<tr>";
		$htmlTable .= "<td class='column'>$key</td>";
		$htmlTable .= "<td class='column column--strong'>$value</td>";
		$htmlTable .= "</tr>";
	}

	$htmlTable .= "</tbody></table>";

	return $htmlTable;
}

/**
* Send user message to email (ajax action)
*/
add_action('wp_ajax_send_message', __NAMESPACE__ . '\\sendMessage');
add_action('wp_ajax_nopriv_send_message', __NAMESPACE__ . '\\sendMessage');

function sendMessage()
{
	try {
    // Валидация
		if (empty($_POST['name']) || empty($_POST['phone'])) {
			throw new Exception('Заполните все обязательные поля отмеченные звездочкой*.');
		}

		// Подготовка email параметров
		$admin_email = get_option('admin_email');
		$site_url = get_site_url();
		$site_name = get_bloginfo('name');
		$subject = "Новое сообщение от посетителя сайта '$site_name' [$site_url]";
    $headers = ['content-type: text/html'];
    
		// Подготовка HTML кода email сообщения
		$userdataTable = renderHTMLTableForArray(array(
			"Имя" => $_POST['name'],
			"Фамилия" => $_POST['lastname']? $_POST['lastname'] : 'Не указано',
			"Номер телефона" => $_POST['phone'],
			"Email" => $_POST['email']? $_POST['email'] : 'Не указано',
			"Сообщение" => $_POST['message']? $_POST['message'] : 'Не указано'
		), "Отправитель: ");

		$body = renderEmailTemplate(array(
			'title' => $subject,
			'content' => $userdataTable,
		));

		// Отправка email сообщения
		if (wp_mail($admin_email, $subject, $body, $headers)) {
			$response_message = '<div class="font-700 text-lg text-secondary-500">Ваше сообщение успешно отправлено.</div><div class="text-gray-600 mt-4">Наш менеджер свяжется с вами в ближайшее время</div>';
			echo json_encode(array('status' => 'success', 'message' => $response_message));
		} else {
			throw new Exception("Во время отправки запроса произошла внутренняя ошибка, попробуйте еще раз позднее.");
		}
	} catch (Exception $e) {
		echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
	}
	wp_die();
}
