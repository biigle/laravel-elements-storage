<?php

namespace Biigle\Filesystem;


use Biigle\Flysystem\Elements\ElementsAdapter as BaseAdapter;

class ElementsAdapter extends BaseAdapter
{
    /**
     * Get the temporary URL for the file at the given path.
     *
     * @param  string  $path
     * @param DateTime $expiration
     * @param array $options
     * @return string
     */
    public function getTemporaryUrl($path, $expiration, $options)
    {
        $id = $this->getMediaFile($path)['bundle'];

        $response = $this->client->post("api/2/media/share", [
            'json' => [
                'bundles' => [$id],
                'expires' => $expiration->format('c'),
                'link_type' => 'download-proxy',
                'permissions' => [
                    'allow_proxy_download' => true,
                ],
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['full_url'];
    }
}
