<?php

namespace Kulchandu\MediaService\Services;

use Illuminate\Http\UploadedFile;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\Log;

class MediaService
{
    protected $storageType;
    protected $s3Client;
    protected $awsBucket;

    public function __construct()
    {
        $this->storageType = config('filesystems.disks.s3.bucket') ? 'aws' : 'local';

        $this->s3Client = new S3Client([
            'region'      => config('filesystems.disks.s3.region'),
            'version'     => 'latest',
            'credentials' => [
                'key'    => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
        ]);
        $this->awsBucket = config('filesystems.disks.s3.bucket');
    }

    public function uploadAndAssociate(UploadedFile $file)
    {

        if ($this->storageType === 'local') {
            $imagePath = $file->store('uploads', 'public');
        } elseif ($this->storageType === 'aws') {
            $imagePath = $this->uploadFileS3Bucket($file);
        } else {
            throw new \InvalidArgumentException('Invalid storage type');
        }

        return $imagePath; // Return the created media path
    }
    public function uploadFileS3Bucket($file, $bucketName = null, $destinationPath = null)
    {
        try {

            $filePath = $destinationPath ? $destinationPath : 'uploads/' . rand(0, 999999) . $file->getClientOriginalName();
            $bucket   = $bucketName ? $bucketName : $this->awsBucket;

            $result   = $this->s3Client->putObject([
                'Bucket'     => $bucket,
                'Key'        => $filePath,
                'SourceFile' => $file->getRealPath(),
            ]);

            return $result['ObjectURL'];
        } catch (\Exception $e) {
            Log::error(['SC3BucketError' => $e->getMessage()]);
        }
        return false;
    }
}
