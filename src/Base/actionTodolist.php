<?php


namespace Base;


class actionTodolist extends DataBase
{
    public function selectList()
    {

        $response = $this->query('SELECT * FROM list order by id DESC ');
        return $response->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function addList()
    {

        $id = $_SESSION['id'];
        $nom = $_POST['tache'];
        $time = time();
        $this->query('INSERT INTO list (`id_utilisateurs`, `nom`, `date_creation`, `date_fin`, `checked`) VALUES (?,?,?,?,?)', [
            $id,
            $nom,
            $time,
            0,
            0,
        ]);
        $insert = $this->query('SELECT * FROM list WHERE id = ? ', [$this->lastInsertId()]);
        $insert = $insert->fetch(\PDO::FETCH_ASSOC);
        $dataTime = new \DateTime();
        $dataTime->setTimestamp($insert['date_creation']);
        return [
            'list' => [
                'id' => $insert['id'],
                'nom' => $insert['nom'],
                'date' => $dataTime->format('d/m/Y H:i')
            ]
        ];


    }

    public function deleteList()
    {
        $delete = $_POST['id'];
        $this->query('DELETE FROM list WHERE id = ?', [
            $delete
        ]);

        return $delete;

    }

    public function checkedList()
    {
        $id = $_SESSION['id'];
        $checked = $_POST['checked'];
        $check = $checked ? 1 : 0;
        $this->query('SELECT id, checked FROM list WHERE id = ?',[
            $id,
            $checked,
        ])->fetch(\PDO::FETCH_ASSOC);
        $this->query("UPDATE todos SET checked=$check WHERE id=$id");
        if ($response) {

            echo $checked;

        }else {
            echo "error";
        }

    }
}