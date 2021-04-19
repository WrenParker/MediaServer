<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;

use Aws\Exception\AwsException;

function connectS3(){
  $s3Client = S3Client::factory(array(
      'credentials' => array(
        'key'    => 'AKIAUSS2OBMN2P5YHXAR',
        'secret' => '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',
      ),
      'region' => 'us-east-1',
      'version' => 'latest'
  ));

  return $s3Client;
}
// Create an Amazon S3 client object

function insertIntoS3($key, $url){
  $s3Client = connectS3();
  $result = $s3Client->putObject([
        'Bucket' => 'wren-parker',
        'Key' => $key,
        'SourceFile' => $url,
  ]);
  return TRUE;
}
function getURL($key) {
  $s3Client = connectS3();
  $cmd = $s3Client->getCommand('GetObject', [
    'Bucket' => "wren-parker",
    'Key'    => $key
  ]);
  $request = $s3Client->createPresignedRequest($cmd, '+1 minute');
  $signedUrl = (string) $request->getUri();

  return $signedUrl;
}
  ?>
