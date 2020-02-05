<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%reply}}`.
 */
class m200201_061158_add_position_column_to_reply_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%reply}}', 'status', $this->string(10)->notNull()->defaultValue('new'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%reply}}', 'status');
    }
}
