<?php

namespace Shieldforce\FrameSf\Enums;

enum ChannelsLogsEnum : string
{
    case LogBootSystem           = "LogBootSystem";
    case LogInternalReneric      = "LogInternalReneric";
    case LogExternalPackage      = "LogExternalPackage";
    case LogInternalHelpersCore  = "LogInternalHelpersCore";
}