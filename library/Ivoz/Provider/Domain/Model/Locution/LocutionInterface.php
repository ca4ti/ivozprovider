<?php

namespace Ivoz\Provider\Domain\Model\Locution;

use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
* LocutionInterface
*/
interface LocutionInterface extends LoggableEntityInterface, FileContainerInterface
{
    const STATUS_PENDING = 'pending';

    const STATUS_ENCODING = 'encoding';

    const STATUS_READY = 'ready';

    const STATUS_ERROR = 'error';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null);

    /**
     * Add TempFile and set status to pending
     *
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     */
    public function addTmpFile(string $fldName, TempFile $file);

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get status
     *
     * @return string | null
     */
    public function getStatus(): ?string;

    /**
     * Get encodedFile
     *
     * @return EncodedFile
     */
    public function getEncodedFile(): EncodedFile;

    /**
     * Get originalFile
     *
     * @return OriginalFile
     */
    public function getOriginalFile(): OriginalFile;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @throws \Exception
     * @return void
     */
    public function removeTmpFile(TempFile $file);

    /**
     * @return \Ivoz\Core\Domain\Service\TempFile[]
     */
    public function getTempFiles();

    /**
     * @var string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName);

}
