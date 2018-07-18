<?php

use yii\db\Migration;

/**
 * Class m180418_070152_seo_module
 */
class m180418_070152_seo_module extends Migration
{
    public $seo_rules = '{{seo_rules}}';
    public $seo_rules_lang = '{{seo_rules_lang}}';
    public $seo = '{{seo}}';
    public $seo_lang = '{{seo_lang}}';
    public $seo_redirect = '{{seo_redirect}}';

    public function safeUp()
    {
        $this->createTable($this->seo_rules, [
            'id' => $this->primaryKey(),
            'name' => $this->string(300),
            'model_name' => $this->string(),
            'status' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'hint' => $this->string(400),
            'additional_data' => $this->json(),
            're_generate' => $this->integer()->defaultValue(1)
        ]);

        $this->createTable($this->seo_rules_lang, [
            'lang_id' => $this->integer()->notNull(),
            'record_id' => $this->integer()->notNull(),
            'title_template' => $this->string(300),
            'description_template' => $this->string(400),
            'keywords_template' => $this->string(400),
            'h1_template' => $this->string(400),
            'og_title_template' => $this->string(300),
            'og_description_template' => $this->string(300),
        ]);

        $this->addForeignKey('seo_rules_lang_record-id', $this->seo_rules_lang, 'record_id', $this->seo_rules, 'id', 'CASCADE');
        $this->addForeignKey('seo_rules_lang_lang-id', $this->seo_rules_lang, 'lang_id', '{{lang}}', 'id', 'CASCADE');
        $this->addPrimaryKey('seo_rules_lang-pk', $this->seo_rules_lang, ['record_id', 'lang_id']);

        $this->createTable($this->seo, [
            'id' => $this->primaryKey(),
            'table_name' => $this->string(),
            'seo_rules_id' => $this->integer()->null(),
            'model_id' => $this->integer(),
            'og_image' => $this->string(350),
            'redirect_301' => $this->string(300),
            'meta_index' => $this->string(300),
            're_generate' => $this->integer()->defaultValue(1)
        ]);

        $this->addForeignKey('seo_seo-rules-id', $this->seo, 'seo_rules_id', $this->seo_rules, 'id', 'CASCADE');

        $this->createTable($this->seo_lang, [
            'lang_id' => $this->integer()->notNull(),
            'record_id' => $this->integer()->notNull(),
            'h1' => $this->string(300),
            'title' => $this->string(300),
            'description' => $this->string(400),
            'keywords' => $this->string(400),
            'og_title' => $this->string(300),
            'og_description' => $this->string(400),

        ]);

        $this->addPrimaryKey('seo_lang-pk', $this->seo_lang, ['record_id', 'lang_id']);
        $this->addForeignKey('seo_lang_record-id', $this->seo_lang, 'record_id', $this->seo, 'id', 'CASCADE');
        $this->addForeignKey('seo_lang_lang-id', $this->seo_lang, 'lang_id', '{{lang}}', 'id', 'CASCADE');

        $this->createTable($this->seo_redirect, [
            'id' => $this->primaryKey(),
            'from_url' => $this->string(500)->notNull(),
            'to_url' => $this->string(500)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->seo_lang);
        $this->dropTable($this->seo);
        $this->dropTable($this->seo_rules_lang);
        $this->dropTable($this->seo_rules);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180418_070152_seo_module cannot be reverted.\n";

        return false;
    }
    */
}
