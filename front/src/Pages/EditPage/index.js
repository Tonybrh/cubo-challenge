import React, {useState, useEffect} from 'react';
import {useParams, useNavigate} from 'react-router-dom';
import api from '../../Utils/api';
import * as S from '../DashboardPage/style';
import {TaskStatusEnum} from "../../Enum/taskEnum";

export default function EditTaskPage() {
    const {taskId} = useParams();
    const navigate = useNavigate();
    const [task, setTask] = useState(null);
    const [loading, setLoading] = useState(true);
    const [formData, setFormData] = useState({
        title: '',
        description: '',
        task_status_id: TaskStatusEnum.PENDING
    });

    useEffect(() => {
        const fetchTask = async () => {
            try {
                const response = await api.get(`/task/${taskId}`);
                setTask(response.data);
                setFormData({
                    title: response.data.title,
                    description: response.data.description,
                    status: response.data.status
                });
            } catch (error) {
                console.error('Failed to fetch task', error);
            } finally {
                setLoading(false);
            }
        };
        fetchTask();
    }, [taskId]);

    const handleChange = (e) => {
        const {name, value} = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value
        }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await api.put(`/task/update/${taskId}`, formData);
            navigate('/dashboard');
        } catch (error) {
            console.error('Failed to update task', error);
        }
    };

    const handleDelete = async () => {
        if (window.confirm('Tem certeza que deseja excluir esta tarefa?')) {
            try {
                await api.delete(`/task/delete/${taskId}`);
                navigate('/dashboard');
            } catch (error) {
                console.error('Failed to delete task', error);
            }
        }
    };

    if (loading) {
        return <S.DashboardContainer>Carregando...</S.DashboardContainer>;
    }

    if (!task) {
        return <S.DashboardContainer>Task não encontrada</S.DashboardContainer>;
    }

    return (
        <S.DashboardContainer>
            <h2>Editar Task</h2>

            <form onSubmit={handleSubmit}>
                <div>
                    <label>Título:</label>
                    <S.Input
                        type="text"
                        name="title"
                        value={formData.title}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div>
                    <label>Descrição:</label>
                    <S.TextArea
                        name="description"
                        value={formData.description}
                        onChange={handleChange}
                        rows="4"
                    />
                </div>

                <div>
                    <label>Status:</label>
                    <S.Select
                        name="task_status_id"
                        value={formData.task_status_id}
                        onChange={handleChange}
                    >
                        <option value={TaskStatusEnum.PENDING}>Pendente</option>
                        <option value={TaskStatusEnum.IN_PROGRESS}>Em andamento</option>
                        <option value={TaskStatusEnum.COMPLETED}>Concluída</option>
                    </S.Select>
                </div>

                <div style={{display: 'flex', gap: '1rem'}}>
                    <S.EditButton type="submit">
                        Salvar Alterações
                    </S.EditButton>
                    <S.DeleteButton type="button" onClick={handleDelete}>
                        Excluir Task
                    </S.DeleteButton>
                </div>
            </form>
        </S.DashboardContainer>
    );
};
