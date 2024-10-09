<?php
/************************************************************************
 * This file is part of EspoCRM.
 *
 * EspoCRM – Open Source CRM application.
 * Copyright (C) 2014-2024 Yurii Kuznietsov, Taras Machyshyn, Oleksii Avramenko
 * Website: https://www.espocrm.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word.
 ************************************************************************/

namespace tests\integration\Espo\Account;

use Espo\Core\Record\ServiceContainer;
use Espo\Core\Select\SearchParams;

class SearchTest extends \tests\integration\Core\BaseTestCase
{
    protected ?string $dataFile = 'Account/ChangeFields.php';

    protected ?string $userName = 'admin';
    protected ?string $password = '1';

    public function testSearchByName(): void
    {
        $service = $this->getContainer()
            ->getByClass(ServiceContainer::class)
            ->get('Account');

        $params = [
            'where' => [
                [
                    'type' => 'textFilter',
                    'value' => 'Besha',
                ],
            ],
            'offset' => 0,
            'maxSize' => 20,
            'asc' => true,
            'sortBy' => 'name',
        ];

        $result = $service->find(SearchParams::fromRaw($params));

        $this->assertEquals(1, $result->getTotal());

        $this->assertInstanceOf('Espo\\ORM\\EntityCollection', $result->getCollection());

        $list = $result->getCollection()->getValueMapList();

        $this->assertEquals('53203b942850b', $list[0]->id);
    }
}
