<?php
   require 'aws-autoloader.php';

   /*
   // Instantiate an Amazon S3 client.
$s3 = new S3Client([
    'endpoint' => 'https://s3.us-east-005.backblazeb2.com',
    'profile' => 'b2',
    'version' => 'latest'
]);
*/

use Aws\S3\S3Client;

$config = [
    'credentials' => [
        'key' => '005cd355419c3600000000003',
        'secret' => 'K005Nfogz4kO1wIFS06cE1HO6LlVgKM',
    ],
    'endpoint' => 'https://s3.us-east-005.backblazeb2.com',
    'region' => 'us-east-005', // Replace with your desired AWS region
    'version' => 'latest',
    'http' => [
        'verify' => '/Documents/pgp/cacert.crt', // Specify the path to your custom CA certificate bundle
    ],
];
$s3Client = S3Client::factory($config);
/*
// Instantiate the S3 client using your B2profile
$s3Client = S3Client::factory(array(
'endpoint' => 'https://s3.us-east-005.backblazeb2.com',
'region' => 'us-east-005',
'version' => 'latest',
));
*/
/*
//Sample to create a bucket
$s3Client->createBucket(array('Bucket' => 'New-Bucket'));
*/
$buckets=array();
try {
    $result = $s3Client->listBuckets();
    foreach ($result['Buckets'] as $bucket) {
        echo "Bucket Name: {$bucket['Name']}\n";
        $buckets[]=$bucket['Name'];
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

//print_r($s3Client);

try {
    $contents = $s3Client->listObjects([
        'Bucket' => "iCWLNet-bucket",
    ]);
    echo "The contents of your bucket are: \n";
    foreach ($contents['Contents'] as $content) {
        echo $content['Key'] . "\n";
    }
} catch (Exception $exception) {
    echo "Failed to list objects in $bucket_name with error: " . $exception->getMessage();
    exit("Please fix error with listing objects before continuing.");
}


?>