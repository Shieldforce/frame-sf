<?php

namespace App\Enums;

enum ChannelsLogsEnum : string
{
    case LogBootSystem       = "LogBootSystem";
    case LogInternalReneric  = "LogInternalReneric";
    case LogExternalPackage  = "LogExternalPackage";
}