import React, {useEffect, useState} from 'react';
import api from '../../Utils/api'
import Cookies from 'js-cookie';
import * as S from './style'
import {useNavigate} from "react-router-dom";
import {TaskStatusEnum} from "../../Enum/taskEnum";

export default function Dashboard() {
    const [user, setUser] = useState(null);
    const [tasks, setTasks] = useState([]);
    const [loading, setLoading] = useState(true);
    const navigate = useNavigate();
    const [selectedStatus, setSelectedStatus] = useState('all');
    const [filteredTasks, setFilteredTasks] = useState([]);

    const fetchTasks = async (status = null) => {
        try {
            let url = '/task/all';
            if (status && status !== 'all') {
                url = `/task/filtered?status=${status}`;
            }
            const response = await api.get(url);
            setTasks(response.data);
        } catch (error) {
            console.error('Failed to fetch tasks', error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        const fetchUser = async () => {
            try {
                const response = await api.get('/system/me');
                setUser(response.data);

                const responseTasks = await api.get('/task/all');
                setTasks(responseTasks.data);
            } catch (error) {
                console.error('Failed to fetch user', error);
            } finally {
                setLoading(false);
            }
        };
        fetchUser();
    }, []);

    const handleLogout = () => {
        Cookies.remove('authToken');
        window.location.href = '/auth';
    };

    const handleEditTask = (taskId) => {
        navigate(`/edit-task/${taskId}`);
    };

    const handleStatusFilterChange = async (e) => {
        const status = e.target.value;
        setSelectedStatus(status);
        setLoading(true);
        await fetchTasks(status !== 'all' ? status : null);
    };

    const handleCreateTask = () => {
        navigate('/create-task');
    };


    const handleDeleteTask = async (taskId) => {
        if (window.confirm('Tem certeza que deseja excluir esta tarefa?')) {
            try {
                await api.delete(`/task/delete/${taskId}`);
                setTasks(tasks.filter(task => task.id !== taskId));
            } catch (error) {
                console.error('Failed to delete task', error);
            }
        }
    };

    if (loading) {
        return <S.DashboardContainer>Carregando...</S.DashboardContainer>;
    }

    return (
        <S.DashboardContainer>
            <S.Header>
                <div>
                    <S.Title>{user && (<span> Seja bem- vindo a sua lista de tarefas, {user.name}</span>)}</S.Title>
                    {tasks.length === 0 && (<span> Você não possui tarefas cadastradas</span>)}
                </div>
                <div>
                    <S.CreateButton onClick={handleCreateTask}>Criar tarefa</S.CreateButton>
                    <S.LogoutButton onClick={handleLogout}>Sair</S.LogoutButton>
                </div>
            </S.Header>
            <S.FiltersContainer>
                <S.FilterLabel>Filtros:</S.FilterLabel>
                <S.FilterSelect
                    value={selectedStatus}
                    onChange={handleStatusFilterChange}
                >
                    <option value="all">Todos</option>
                    <option value={TaskStatusEnum.PENDING}>Pendentes</option>
                    <option value={TaskStatusEnum.IN_PROGRESS}>Em andamento</option>
                    <option value={TaskStatusEnum.COMPLETED}>Concluídas</option>
                </S.FilterSelect>
            </S.FiltersContainer>
            {selectedStatus !== 'all' ?
                <span>Exibindo tarefas {TaskStatusEnum.getLabel(selectedStatus)} ordenadas pela data de criação</span>
                : <span>Exibindo todas as tarefas</span>
            }
            <S.TasksGrid>
                {tasks.map(task => (
                    <S.TaskCard key={task.id}>
                        <S.TaskTitle>{task.title}</S.TaskTitle>
                        <S.TaskDescription>
                            {task.description || 'Sem descrição'}
                        </S.TaskDescription>
                        <div>
                            <S.TaskStatus task_status_id={task.task_status_id}>
                                {TaskStatusEnum.getLabel(task.task_status_id)}
                            </S.TaskStatus>
                            <S.CommentButton onClick={() => navigate(`/task/${task.id}/comments`)}>
                                Ver Comentários
                            </S.CommentButton>
                            <S.EditButton onClick={() => handleEditTask(task.id)}>
                                Editar
                            </S.EditButton>
                            <S.DeleteButton onClick={() => handleDeleteTask(task.id)}>
                                Excluir
                            </S.DeleteButton>
                        </div>
                    </S.TaskCard>
                ))}
            </S.TasksGrid>
        </S.DashboardContainer>
    );
};
