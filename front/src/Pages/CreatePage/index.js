import React, {useState} from 'react';
import {useNavigate} from 'react-router-dom';
import api from '../../Utils/api';
import * as S from '../DashboardPage/style';
import {TaskStatusEnum} from '../../Enum/taskEnum';

export default function CreateTaskPage() {
    const navigate = useNavigate();
    const [formData, setFormData] = useState({
        title: '',
        description: '',
        task_status_id: TaskStatusEnum.PENDING
    });
    const [loading, setLoading] = useState(false);

    const handleChange = (e) => {
        const {name, value} = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value
        }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);

        try {
            await api.post('/task/create', formData);
            navigate('/dashboard');
        } catch (error) {
            console.error('Failed to create task', error);
        } finally {
            setLoading(false);
        }
    };

    return (
        <S.DashboardContainer>
            <h2>Criar Nova Tarefa</h2>

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
                        <option value=''>Selecione</option>
                        <option value={TaskStatusEnum.PENDING}>Pendente</option>
                        <option value={TaskStatusEnum.IN_PROGRESS}>Em andamento</option>
                        <option value={TaskStatusEnum.COMPLETED}>Concluída</option>
                    </S.Select>
                </div>

                <div style={{display: 'flex', gap: '1rem', marginTop: '1rem'}}>
                    <S.EditButton type="submit" disabled={loading}>
                        {loading ? 'Criando...' : 'Criar Tarefa'}
                    </S.EditButton>
                    <S.DeleteButton type="button" onClick={() => navigate('/dashboard')}>
                        Cancelar
                    </S.DeleteButton>
                </div>
            </form>
        </S.DashboardContainer>
    );
};
