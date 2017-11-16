<?php

namespace AppBundle\Admin\Media;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
            ->add('id', null, ['disabled' => true])
            ->add('name')
            ->add('file', 'file')
            ->add('caption')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('id')
            ->addIdentifier('name')
            ->add('filename')
            ->add('_action', null, [
                    'actions' => [
                        'show' => [],
                        'edit' => [],
                        'delete' => [],
                ]
            ])
        ;
    }

    public function prePersist($image) {
        $this->manageFileUpload($image);
    }

    public function preUpdate($image) {
        $this->manageFileUpload($image);
    }

    private function manageFileUpload($image) {
        if (!$image->getFile() === null) {
            return;
        }

        $ftp_server = $this->getConfigurationPool()->getContainer()->getParameter('ftp_server');
        $ftp_username = $this->getConfigurationPool()->getContainer()->getParameter('ftp_username');
        $ftp_password = $this->getConfigurationPool()->getContainer()->getParameter('ftp_password');

        $tmp_path = $image->getFile()->getRealPath();
        $filename = $image->getFile()->getClientOriginalName();

        $connection = ftp_connect($ftp_server);
        $login_result = ftp_login($connection, $ftp_username, $ftp_password);
        if (!$connection || !$login_result) {
            throw new \Exception('Unable to connect to FTP server');
        }

        $upload = ftp_put($connection, $filename, $tmp_path, FTP_BINARY);

        ftp_close($connection);

        $image->setFilename($filename);
        $image->setFile(null);
    }

}
