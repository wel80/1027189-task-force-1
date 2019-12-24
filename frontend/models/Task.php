<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $category_id
 * @property string $status
 * @property string $description
 * @property string $expire
 * @property string $name
 * @property string|null $address
 * @property int|null $budget
 * @property float $latitude
 * @property float $longitude
 * @property int $author_id
 * @property int|null $executor_id
 *
 * @property File[] $files
 * @property Opinion[] $opinions
 * @property Reply[] $replies
 * @property User $author
 * @property User $executor
 * @property Category $category
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'expire'], 'safe'],
            [['category_id', 'status', 'description', 'expire', 'name', 'latitude', 'longitude', 'author_id'], 'required'],
            [['category_id', 'budget', 'author_id', 'executor_id'], 'integer'],
            [['description'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['status'], 'string', 'max' => 10],
            [['name', 'address'], 'string', 'max' => 100],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['executor_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'category_id' => 'Category ID',
            'status' => 'Status',
            'description' => 'Description',
            'expire' => 'Expire',
            'name' => 'Name',
            'address' => 'Address',
            'budget' => 'Budget',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'author_id' => 'Author ID',
            'executor_id' => 'Executor ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpinions()
    {
        return $this->hasMany(Opinion::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Reply::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function filterByCategories(array $filters)
    {
        if (isset($filters['categories'])) {
            return $this->andWhere(['category.icon' => $filters['categories']]);
        }
        return $this;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function filterByRemoteWork(array $filters)
    {
        if (isset($filters['additionally']) && in_array('remoteWork', $filters['additionally'])) {
            return $this->andWhere([
                'task.latitude' => NULL,
                'task.longitude' => NULL
            ]);
        }
        return $this;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function filterByPeriod(array $filters)
    {
        if (isset($filters['period'])) {
            $now = new \DateTime('now');
            $interval = new \DateInterval($filters['period']);
            $startDate = $now->sub($interval)->format('Y-m-d H:i:s');
            return $this->andWhere(['>', 'task.created_at', $startDate]);
        }
        return $this;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function filterBySearch(array $filters)
    {
        if (isset($filters['search'])) {
            return $this->andWhere(['like', 'task.name', $filters['search']]);
        }
        return $this;
    }
}
