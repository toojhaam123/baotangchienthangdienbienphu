<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../image/Logo bảo tàng.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Điều khoản sử dụng</title>
</head>

<body>

</body>
<div class="container-fluid">
    <div class="row d-flex">
        <div class="col-md-2 d-none d-lg-block">
        </div>
        <div class="col-md-12 col-12 col-md-12">
            <?php
            function readDocxFormatted($filePath)
            {
                $zip = new ZipArchive;
                $output = '';

                if ($zip->open($filePath) === true) {
                    if (($index = $zip->locateName('word/document.xml')) !== false) {
                        $data = $zip->getFromIndex($index);
                        $zip->close();

                        // Tách đoạn văn <w:p> và nội dung văn bản <w:t>
                        $xml = simplexml_load_string($data);
                        $xml->registerXPathNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');

                        $paragraphs = $xml->xpath('//w:p');
                        foreach ($paragraphs as $paragraph) {
                            $texts = $paragraph->xpath('.//w:t');
                            foreach ($texts as $text) {
                                $output .= (string) $text;
                            }
                            $output .= "\n"; // Xuống dòng sau mỗi đoạn
                        }

                        return nl2br($output); // Hiển thị xuống dòng trong trình duyệt
                    } else {
                        return 'Không tìm thấy file document.xml trong DOCX.';
                    }
                } else {
                    return 'Không thể mở file DOCX.';
                }
            }

            echo readDocxFormatted("ĐIỀU KHOẢN SỬ DỤNG.docx");
            ?>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

</html>