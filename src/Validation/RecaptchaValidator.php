<?php

/**
 * RecaptchaValidator
 *
 * @author   anhtuank7c
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://crabstudio.info/
 */

namespace Recaptcha\Validation;

use Cake\Validation\Validator;

/**
 * RecaptchaValidator
 */
class RecaptchaValidator extends Validator {

    protected $validList = [
        'type' => [
            'audio',
            'image'
        ],
        'theme' => [
            'light',
            'dark'
        ]
    ];

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this
                ->requirePresence('sitekey')
                ->notEmpty('sitekey', __d('recaptcha', 'A sitekey cannot be blank.'))
                ->requirePresence('secret')
                ->notEmpty('secret', __d('recaptcha', 'A secret cannot be blank.'))
                ->add('theme', [
                    'inList' => [
                        'rule' => ['inList', $this->validList['theme']],
                        'message' => __d('recaptcha', 'The theme should be in the following authorized theme ' . implode(',', $this->validList['theme'])),
                    ]
                ])
                ->add('type', [
                    'inList' => [
                        'rule' => ['inList', $this->validList['type']],
                        'message' => __d('recaptcha', 'The type should be in the following authorized type ' . implode(',', $this->validList['type'])),
                    ]
        ]);
    }

}
