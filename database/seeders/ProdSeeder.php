<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use Database\Factories\LabelFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdSeeder extends Seeder
{
    private $taskData = [
        ['Исправить ошибку в какой-нибудь строке', 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее'],
        ['Допилить дизайн главной страницы', 'Вёрстка поехала в далёкие края. Нужно удалить бутстрап!'],
        ['Отрефакторить авторизацию', 'Выпилить всё легаси, которое найдёшь'],
        ['Доработать команду подготовки БД', 'За одно добавить тестовых данных'],
        ['Пофиксить вон ту кнопку', 'Кажется она не того цвета'],
        ['Исправить поиск', 'Не ищет то, что мне хочется'],
        ['Добавить интеграцию с облаками', 'Они такие мягкие и пушистые'],
        ['Выпилить лишние зависимости', ''],
        ['Запилить сертификаты', 'Кому-то же они нужны?'],
        ['Выпилить игру престолов', 'Этот сериал никому не нравится! :)'],
        ['Пофиксить спеку во всех репозиториях', ' Передать Олегу, чтобы больше не ронял прод'],
        ['Вернуть крошки', 'Андрей, это задача для тебя'],
        ['Установить Linux', 'Не забыть потестировать'],
        ['Поставить чайник', ''],
        ['Добавить поиск по фото', 'Только не по моему'],
        ['Обновить фотошоп', '']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $col = collect($this->taskData);
        $labels = Label::all();
        User::factory()->count(15)->create();
        Task::factory()->count(16)->sequence(function ($sequence) use (&$col) {
            $piece = $col->shift();
            $col = $col->shuffle();
            return [
            'name' => $piece[0],
            'description' => $piece[1],
            'created_by_id' => rand(1,15),
            'assigned_to_id' => rand(1, 15),
            ];
        }
    )
            ->create()
            ->each(function ($task) use ($labels) {
                $task->labels()->attach($labels->random(rand(1,3)));
            });
    }
}
