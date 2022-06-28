'file_upload' => [
'rules' =>
'uploaded[file_upload]|mime_in[file_upload,image/JPG,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]',
'errors' => [
'mime_in' => 'Format File salah',
'max_size' => 'Maximal size 4 mb',
'uploaded' => 'File tidak terupload',
]
],



$upload = $this->request->getFile('file_upload');
$upload->move(ROOTPATH.'template/assets/img/bukti-bayar-operation-list');

'upload_pembayaran' => $upload->getName(),