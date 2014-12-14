pdfpop
======

Utilizing [Mike Haertl's PHP PPDFTK library](https://github.com/mikehaertl/php-pdftk), this is a simple application which can be set up on a Web server and provide population of PDF's which contain form fields.  Simply POST your data to the endpoint (index.php).  Your POST data must include the PDF you wish to be populated (the field name must be called "file") and additional fields whose names match the field names on the PDF.  The response will contain the binary of the populated PDF.
