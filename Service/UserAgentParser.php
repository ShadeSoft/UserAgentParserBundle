<?php

namespace ShadeSoft\UserAgentParserBundle\Service;

class UserAgentParser {

    /**
     * Returns an associative array with the browser's name and version
     *
     * @param string $ua - UserAgent
     * @return array
     */
    public function getBrowser($ua) {
        $browserMap = [
            'Internet Explorer'     => '/msie|trident[^:]*[:]?([0-9]*)/i',
            'Firefox'               => '#firefox[/]?([0-9]*)#i',
            'Edge'                  => '#edge[/]?([0-9]*)#i',
            'Opera'                 => '#opera|opr[/]?([0-9]*)#i',
            'Opera Neon'            => '#mms[/]?([0-9]*)#i',
            'Maxthon'               => '#maxthon[/]?([0-9]*)#i',
            'Chrome'                => '#chrome[/]?([0-9]*)#i',
            'Safari'                => '/safari/i',
            'Netscape'              => '/netscape/i',
            'Konqueror'             => '/konqueror/i',
            'Unknown Mobile'        => '/mobile/i'
        ];
        foreach($browserMap as $browser => $regex) {
            if(preg_match($regex, $ua, $matches)) {
                return [
                    'name'      => $browser,
                    'version'   => (isset($matches[1]) && $matches[1]) ? $matches[1] : null
                ];
            }
        }
        return [
            'name'      => 'Unknown',
            'version'   => null
        ];
    }

    /**
     * Returns an associative array with the OS's name and version
     *
     * @param string $ua - UserAgent
     * @return array
     */
    public function getOS($ua) {
        $osMap = [
            'Windows::10'                   => '/windows[\s]*nt[\s]*10/i',
            'Windows::8.1'                  => '/windows[\s]*nt[\s]*6.3/i',
            'Windows::8'                    => '/windows[\s]*nt[\s]*6.2/i',
            'Windows::7'                    => '/windows[\s]*nt[\s]*6.1/i',
            'Windows::Vista'                => '/windows[\s]*nt[\s]*6.0/i',
            'Windows::Server 2003/XP x64'   => '/windows[\s]*nt[\s]*5.2/i',
            'Windows::XP'                   => '/(windows[\s]*nt[\s]*5.1)|(windows[\s]*xp)/i',
            'Windows::2000'                 => '/windows[\s]*nt[\s]*5.0/i',
            'Windows::ME'                   => '/windows[\s]*me/i',
            'Windows::98'                   => '/win98/i',
            'Windows::95'                   => '/win95/i',
            'Windows::3.11'                 => '/win16/i',
            'iOS::#'                        => '/iphone|ipod|ipad[^o]*os[\s]*([0-9_]*)/i',
            'Mac OS::X'                     => '/macintosh|mac[\s]*os[\s]*x/i',
            'Mac OS::9'                     => '/mac_powerpc/i',
            'Ubuntu::'                      => '/ubuntu/i',
            'Android::#'                    => '/android[\s]*([0-9.]*)/i',
            'Linux::'                       => '/linux/i',
            'BlackBerry::'                  => '/blackberry/i',
            'Unknown Mobile::'              => '/webos/i'
        ];
        foreach($osMap as $os => $regex) {
            if(preg_match($regex, $ua, $matches)) {
                if(strpos($os, '#')) {
                    $os = str_replace('#', ((isset($matches[1]) && $matches[1]) ? (' ' . str_replace('_', '.', $matches[1])) : ''), $os);
                }
                $xOs = explode('::', $os);
                return [
                    'name'      => $xOs[0],
                    'version'   => (isset($xOs[1]) && $xOs[1]) ? $xOs[1] : null
                ];
            }
        }
        return [
            'name'      => 'Unknown',
            'version'   => null
        ];
    }
}