<?php

namespace PHPExiftool\Driver\Tag\DICOM;

class AngioFlag extends \PHPExiftool\Driver\Tag
{

    protected $Id = '0018,0025';

    protected $Name = 'AngioFlag';

    protected $FullName = 'DICOM::Main';

    protected $GroupName = 'DICOM';

    protected $g0 = 'DICOM';

    protected $g1 = 'DICOM';

    protected $g2 = 'Image';

    protected $Type = '?';

    protected $Writable = false;

    protected $Description = 'Angio Flag';

}