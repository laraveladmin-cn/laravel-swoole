<?php

namespace SwooleTW\Http\Server\Resetters;

use SwooleTW\Http\Server\Sandbox;
use Illuminate\Contracts\Container\Container;
use Illuminate\Config\Repository;

class ResetConfig implements ResetterContract
{
    /**
     * "handle" function for resetting app.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     * @param \SwooleTW\Http\Server\Sandbox $sandbox
     *
     * @return \Illuminate\Contracts\Container\Container
     */
    public function handle(Container $app, Sandbox $sandbox)
    {
        //深度拷贝配置,不要地址引用
        $items = json_decode(json_encode($sandbox->getConfig()->all()),true);
        $app->instance('config', new Repository($items));
        //$app->instance('config', clone $sandbox->getConfig());

        return $app;
    }
}
